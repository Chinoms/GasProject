<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegForm');
Route::post('/register/admin', 'App\Http\Controllers\Auth\RegisterController@createAdmin');


Route::get('admin/', function () {
    return view('admin.index');
})->middleware('auth');



Route::get('record-purchase', 'App\Http\Controllers\StockController@gasPurchaseForm')->middleware('auth');
Route::post('savegaspurchase', 'App\Http\Controllers\StockController@recordGasPurchase')->name('savegaspurchase')->middleware('auth');
Route::get('pos', 'App\Http\Controllers\PosController@create')->middleware('auth')->name('pos');
Route::post('savesale', 'App\Http\Controllers\PosController@store')->name('savesale')->middleware('auth');
Route::get('new-user', 'App\Http\Controllers\UserController@create')->middleware('auth');
Route::get('purchase-history', 'App\Http\Controllers\StockController@index')->middleware('auth');
Route::post('savestaff', 'App\Http\Controllers\UserController@savestaff')->name('savestaff')->middleware('auth');