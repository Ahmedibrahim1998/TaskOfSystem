<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\View;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::post('/home',function () {
//    return View('welcome'); 
// });


// Route::delete('/delete',function(){
//     return view('welcome');
// });

Route::get('category/index',[CategoryController::class,'index']);