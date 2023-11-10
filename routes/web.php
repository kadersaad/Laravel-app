<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\kaderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', function () {
    return 'Kader';
});

// Route::view('/users','users');

Route::view('/users','users', ['name'=> 'Ghez Abdelkader']);

Route::get('/users/{id}', function (string $id) {
    return 'User '.$id;
});

Route::get('/posts/{post}/comments/{comment}', function (string $postId, string $commentId) {
    return 'Post id '.$postId . ' Comment id '.$commentId;
});


// The '{name?}' part indicates a route parameter named 'name' that is optional (the '?' makes it optional).
Route::get('/myuser/{name?}', function (string $name = 'Kader') {
    // Inside the route callback function:
    
    // If a 'name' parameter is provided in the URL, it will be captured and passed to the $name variable.
    // If no 'name' parameter is provided, the default value 'Kader' will be used.
    return $name;
});

//named route
Route::get('/user/admin/kader', function () {
    // Return an HTML string as the response.
    return '<h1>Hello Kader</h1>';
})->name('kader');

Route::get('/saad', function () {
    // Instead of directly returning a response, use the redirect() function to redirect to a named route.
    // In this case, it redirects to the route with the name 'kader', which corresponds to '/user/admin/kader'.
    return redirect()->route('kader');
});

//first method
Route::get('/kader/saad', function () {
    return view('kader', ['name'=> 'This is Kader Ghez']);
});
//secend method in laravel 10
//Route::view('/kader/saad','kader', ['name'=> 'This is Kader Ghez']);


Route::get('/admin/panel', function () {
    return view('admin.index', ['name'=> 'Welcome Admin']);
});

Route::get('/user/panel', function () {
    return view('users.index', ['name'=> 'Welcome User']);
});

Route::get('/post/panel', function () {
    return view::first(['admin.create', 'admin.index'], ['name'=> 'Welcome Admin']);  // if not found view create go to view index
});

Route::get('/create/user', function () {
    return view('users.create')
                ->with('name1','<h1>saad</h1>')
                ->with('name','<h1>saad</h1>')
                ->with('name2','salim');
}); 

// use controller

Route::get('/kader/test/index', [kaderController::class,'index']);
Route::get('/kader/test/show', [kaderController::class,'show']);
Route::get('/kader/test/edit', [kaderController::class,'edit']);
Route::get('/kader/test/create', [kaderController::class,'create']);