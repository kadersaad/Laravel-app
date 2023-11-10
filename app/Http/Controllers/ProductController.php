<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve a paginated list of products using the Product model.
        // The products are ordered in descending order based on the 'created_at' timestamp.
        // The paginate(5) method is used to limit the number of products per page to 5.
        $products = Product::latest()->paginate(5);

        // Return a view named "products.index" and pass the paginated products to the view using the compact() function.
        // Additionally, calculate the index 'i' to display the correct numbering on the page.
        return view("products.index", compact("products"))
            ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

        //condition
        $request->validate([
            'name'=> 'required',
            'details'=> 'required',
            'image'=> 'required|image|mimes:jpeg,png,ipg,gif,svg|max:2048',
        ]);

        //save in database
        $input = $request->all();
        //save image
        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input["image"] = "$profileImage";
        }

        //model
        Product::create($input);
        return redirect()->route("products.index")->with("success","Products added successfully");

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact("product"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact("product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //condition
        $request->validate([
            'name'=> 'required',
            'details'=> 'required',
        ]);

        //save in database
        $input = $request->all();
        //save image
        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input["image"] = "$profileImage";
        }else {
            unset($input["image"]); // الغي تحديث الصورة
        }

        //model
        $product->update($input);
        return redirect()->route("products.index")->with("success","Products Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route("products.index")->with("success","Products deleted successfully");
    }
}
