<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Validator;

class ProductApiController extends Controller
{
    public function index(){
        $product = Product::all();
        return response()->json([
            "SUCCESS" => true,
            "message" => "All Products",
            "data"=> $product,
            ]);
    }

    public function store(Request $request){
    
        $input = $request->all();
        $validator = Validator::make($input,[
            'name'=> 'required',
            'details'=> 'required',
        ]);

        if( $validator->fails()){
            return response()->json([
                'fail'=> false,
                'message'=> 'Sorry not stored',
                'error'=> $validator->errors()
                ]);
        }

        $product = Product::create($input);

        return response()->json([
            'success'=> true,
            'message'=> 'product created successfully',
            'data'=> $product
            ]);
    }


    public function show($id){

        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json([
                "SUCCESS" => false,
                "message" => "Sorry not found!",
                ]);
        }

        return response()->json([
            "SUCCESS" => true,
            "message" => "Product fetched successfully",
            "data"=> $product,
            ]);
    }

    public function update(Request $request, Product $product){

        $input = $request->all();
        $validator = Validator::make($input,[
            'name'=> 'required',
            'details'=> 'required',
        ]);

        if( $validator->fails()){
            return response()->json([
                'fail'=> false,
                'message'=> 'Sorry not stored',
                'error'=> $validator->errors()
                ]);
        }

        $product->name = $input['name'];
        $product->details = $input['details'];
        $product->save();

        return response()->json([
            'success'=> true,
            'message'=> 'product updated successfully',
            'data'=> $product
            ]);
    }

    public function destroy(Product $product){
        
        $product->delete();

        return response()->json([
            'success'=> true,
            'message'=> 'product deleted successfully',
            'data'=> $product
            ]);
    }


}
