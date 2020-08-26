<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/**
 * Endpoint auth
 */
Route::group(['prefix' => 'auth', 'namespace' => 'api\Auth'], function() {

    Route::post('login', 'LoginController@login');
    Route::post('register', 'RegisterController@register');

    Route::group(['middleware' => 'api.auth'], function() {
        Route::get('user', 'SessionController@getUser')->middleware('api.verified');
        Route::post('logout', 'SessionController@logout');

        Route::post('email/verify/{id}/{hash}', 'VerificationController@verify')->name('email.verify');
        Route::post('email/resend', 'VerificationController@resend');
    });

    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'ResetPasswordController@reset');

});

/**
 * Endpoint lain-lain
 */
Route::group(['middleware' => 'api.auth'], function() {

    Route::any('/', function() {
        return response()->json([
            'status' => 400,
            'message' => 'Bad request'
        ], 400);
    });
    
    Route::any('{any}', function() {
        return response()->json([
            'status' => 400,
            'message' => 'Bad request'
        ], 400);
    })->where('any', '.*');
});
