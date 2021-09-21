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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/login/admin', 'App\Http\Controllers\Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'App\Http\Controllers\Auth\RegisterController@showAdminRegForm');
Route::post('/register/admin', 'App\Http\Controllers\Auth\RegisterController@createAdmin');


// Route::get('admin/', function () {
//     return view('admin.index');
// })->middleware('auth');

// Route::get('view-incentive', function () {
//     return view('view-incentive');
// })->middleware('auth');


Route::get('record-purchase', 'App\Http\Controllers\StockController@gasPurchaseForm')->middleware('auth');
Route::post('savegaspurchase', 'App\Http\Controllers\StockController@recordGasPurchase')->name('savegaspurchase')->middleware('auth');
Route::get('pos', 'App\Http\Controllers\PosController@create')->middleware('auth')->name('pos');
Route::post('savesale', 'App\Http\Controllers\PosController@store')->name('savesale')->middleware('auth');
Route::get('new-user', 'App\Http\Controllers\UserController@create')->middleware('auth');
Route::get('purchase-history', 'App\Http\Controllers\StockController@index')->middleware('auth');
Route::post('savestaff', 'App\Http\Controllers\UserController@savestaff')->name('savestaff')->middleware('auth');
Route::get('view-incentive', 'App\Http\Controllers\UserController@fetchIncentive')->name('fetchIncentive')->middleware('auth');
Route::post('view-incentive', 'App\Http\Controllers\UserController@viewIncentives')->name('viewIncentives')->middleware('auth');
Route::get('settings', 'App\Http\Controllers\SettingsController@edit')->name('settings')->middleware('auth');
Route::post('update-settings', 'App\Http\Controllers\SettingsController@update')->name('update-settings')->middleware('auth');
Route::get('admin', 'App\Http\Controllers\SalesController@dashboard')->name('admin')->middleware('auth');
Route::get('new-expenditure', 'App\Http\Controllers\ExpenditureController@create')->name('new-expenditure')->middleware('auth');
Route::post('save-expenditure', 'App\Http\Controllers\ExpenditureController@store')->name('save-expenditure')->middleware('auth');
Route::get('new-petty-cash', 'App\Http\Controllers\ExpenditureController@newPettyCash')->name('new-petty-cash')->middleware('auth');
Route::post('save-petty-cash', 'App\Http\Controllers\ExpenditureController@savePettyCash')->name('save-petty-cash')->middleware('auth');
Route::get('petty-cash-history', 'App\Http\Controllers\ExpenditureController@index')->name('petty-cash-history')->middleware('auth');
Route::get('expenditure-history', 'App\Http\Controllers\ExpenditureController@expenditureHistory')->name('expenditure-history')->middleware('auth');
Route::get('list-transactions', 'App\Http\Controllers\PosController@listTransactions')->middleware('auth');
Route::get('mark-as-paid/{id}/payment-method/{method}', 'App\Http\Controllers\PosController@markAsPaid')->name('mark-as-paid')->middleware('auth');

Route::get('create-customer', function () {
    return view('add-customer');
});

Route::post('save-customer', 'App\Http\Controllers\CustomerController@store')->name('save-customer');
