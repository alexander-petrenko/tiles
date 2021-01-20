<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {

    //Admin
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
    
        Route::get('/', 'Admin\IndexController@index')->name('adminHome');
        
        
        Route::resource('/categories', 'Admin\CategoryController');
        Route::resource('/products', 'Admin\ProductController');
        Route::resource('/textures', 'Admin\TextureController');
        Route::resource('/brands', 'Admin\BrandController');
        Route::resource('/collections', 'Admin\CollectionController');
        Route::resource('/surfaces', 'Admin\SurfaceController');
        Route::resource('/styles', 'Admin\StyleController');
        Route::resource('/shapes', 'Admin\ShapeController');
        Route::resource('/materials', 'Admin\MaterialController');
        Route::resource('/users', 'Admin\UserController');
    });

    //User
    Route::get('/home', 'HomeController@index')->name('home');

});
