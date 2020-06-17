<?php

use App\Permission;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group( ['middleware' => 'auth:api' ], function() {
    Route::post('/logout', 'Auth\AuthController@logout');
    Route::get('verification/resend', 'Auth\VerificationApiController@resend')->name('verificationapi.resend');
    Route::get('/users/me', 'UserController@getAuthUser');
    Route::delete('/users/me', 'UserController@deleteAuthUser');

    Route::group( ['middleware' => 'verified' ], function() {
        // User
        Route::get('/users', 'UserController@getUsers');
        Route::post('/users', 'UserController@store');
        Route::delete('/users/{user}', 'UserController@destroy');
        Route::put('/users/me', 'UserController@updateAuthUser')->name('updateAuthUser');
        Route::put('/users/{user}', 'UserController@update');

        Route::post('/change-password', 'Auth\ChangePasswordController@store');

        Route::resource('/roles', 'RoleController');
        Route::get('/permissions', function() {
            return Permission::all();
        });

        Route::apiResource('tourists', 'TouristController');
        Route::apiResource('hotels', 'HotelController');
        Route::apiResource('services', 'ServiceController');
        Route::apiResource('orders', 'OrderController');
        Route::apiResource('hotel-reservation', 'HotelReservationController');

        // Payment
        Route::get('/payments', 'PaymentController@index');
        Route::post('/payments', 'PaymentController@store');
    });

});

Route::post('/login', 'Auth\AuthController@login');
Route::post('/refresh_token', 'Auth\AuthController@refreshToken');
Route::post('/register', 'Auth\AuthController@register');
Route::post('/send-reset-link', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/reset-password', 'Auth\ResetPasswordController@reset');
