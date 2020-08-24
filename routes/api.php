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
        Route::get('user', 'SessionController@getUser');
        Route::post('logout', 'SessionController@logout');
    });

});

/**
 * Endpoint lain-lain
 */
Route::group(['middleware' => 'api.auth'], function() {

    Route::any('/', function() {
        return response()->json([
            'status' => 403,
            'message' => 'Bad request'
        ], 403);
    });
    
    Route::any('{any}', function() {
        return response()->json([
            'status' => 403,
            'message' => 'Bad request'
        ], 403);
    })->where('any', '.*');
});
