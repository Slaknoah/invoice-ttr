<?php

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

// Auth::routes();

// Route::get('/', function() { return view('index'); });

Route::get('/testrapid', 'LocationController@index');
Route::get( config('app.locale') .'/reset-password', function() { return view('index');})->name('password.reset');
Route::get( config('app.locale') . '/profile', 'Auth\VerificationApiController@verify')->name('verification.verify');
Route::get('/{any}', function() {  return view('index');})->where('any', '.*');


// Route::group( ['middleware' => 'auth' ], function() {
// 	Route::get('/', 'StatisticsController@index');

// 	Route::resource('invoices', 'InvoiceController');
// 	Route::resource('tourists', 'TouristController');
// 	Route::resource('hotels', 'HotelController');
// 	Route::resource('services', 'ServiceController');

// 	Route::resource('requisites', 'RequisiteController');
// 	Route::resource('providers', 'ProviderController');
// 	Route::resource('hotel_statuses', 'HotelStatusController');
// 	Route::resource('payment_statuses', 'PaymentStatusController');
// 	Route::resource('agents', 'AgentController');

// 	Route::get('profile', 'UserController@profile');
// 	Route::post('profile', 'UserController@update_profile');

// 	Route::get('managers', 'UserController@managers')->name('managers.index');
// 	Route::get('managers/{id}/edit', 'UserController@edit')->name('users.edit');
// 	Route::delete('managers/{id}', 'UserController@destroy')->name('users.destroy');
// 	Route::post('managers', 'UserController@store');

// 	Route::get('administrators', 'UserController@administrators')->name('administrators.index');
// 	Route::get('administrators/{id}/edit', 'UserController@edit')->name('users.edit');
// 	Route::delete('administrators/{id}', 'UserController@destroy')->name('users.destroy');
// 	Route::post('administrators', 'UserController@store');

// 	Route::get('settings', 'SettingController@index')->name('settings.index');
//     Route::post('settings', 'SettingController@store')->name('settings.store');

//     // Ajax routes
//     Route::get('getManagers', 'UserController@getManagers')->name('getManagers');
//     Route::get('hotel/{name}', 'HotelController@getAccommodations')->name('getAccommodations');

// });