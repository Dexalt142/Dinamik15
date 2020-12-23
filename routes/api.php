<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    Route::group(['middleware' => ['api.guard:api', 'api.auth']], function() {
        Route::get('user', 'SessionController@getUser');
        Route::post('logout', 'SessionController@logout');

        Route::post('email/verify/{id}/{hash}', 'VerificationController@verify')->name('email.verify');
        Route::post('email/resend', 'VerificationController@resend');
    });

    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'ResetPasswordController@reset');

});

Route::group(['middleware' => ['api.guard:api', 'api.auth', 'api.verified'], 'namespace' => 'api'], function() {

    Route::group(['prefix' => 'team'], function() {
        Route::get('/', 'TeamController@getTeam');
        Route::post('/register', 'TeamController@registerTeam');
    });

    Route::get('payment', 'PaymentController@getPaymentInfo');
    Route::post('payment/upload', 'PaymentController@uploadPayment');

    Route::post('creation/document', 'CreationController@submitBerkas');
    Route::post('creation/result', 'CreationController@submitKarya');
    
    Route::get('competition', 'CompetitionController@getCompetitions');
});

Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function() {
    Route::post('/auth/login', 'auth\LoginController@login');

    Route::group(['middleware' => ['api.guard:admin', 'api.auth']], function() {
        Route::get('/auth/me', 'auth\SessionController@getAdmin');
        Route::get('/auth/logout', 'auth\SessionController@logout');

        Route::group(['prefix' => 'team'], function() {
            Route::get('/', 'TeamController@getTeams');
            Route::get('/{id}', 'TeamController@getTeamDetail');
        });

        Route::group(['prefix' => 'payment'], function() {
            Route::get('/', 'PaymentController@getPayments');
            Route::get('/{id}', 'PaymentController@getPayment');
            Route::post('/verify', 'PaymentController@verifyPayment');
        });

        Route::group(['prefix' => 'creation'], function() {
            Route::get('/', 'CreationController@getCreations');
        });

        Route::get('statistic', 'DashboardController@getStatistics');
    });
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
