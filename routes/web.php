<?php
use App\Http\Controllers\Controller;

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

Route::get('/', function () { return view('system.dashboard'); });

Route::resource('category', 'CategoryController');
Route::resource('supplier', 'SupplierController');
Route::resource('warehouse', 'WarehouseController');
Route::resource('product', 'ProductController');
Route::resource('career', 'CareerController');
Route::resource('course', 'CourseController');

Route::get('/sale', 'ProductController@sale');
Route::get('/sale/getInfoProduct/{product}', 'ProductController@getInfoProduct');
Route::get('/sale/discountProduct/{product}/{cantidad}', 'ProductController@discountProduct');
