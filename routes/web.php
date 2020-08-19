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

Route::get('/login', 'AuthController@showLoginForm')->name('login');

Route::prefix('auth')->group(function() {
    Route::post('login', 'AuthController@login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
});

// Route::get('/login', 'User\Auth\LoginController@showLoginForm')->name('login');
// Route::get('/register', 'User\Auth\RegisterController@showRegistrationForm')->name('register');

// Route::get('/password/confirm', 'User\Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');

// Route::get('/password/reset', 'User\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::get('/password/reset/{token}', 'User\Auth\ResetPasswordController@showResetForm')->name('password.reset');

// Route::post('/login', 'User\Auth\LoginController@login');
// Route::post('/logout', 'User\Auth\LoginController@logout')->name('logout');
// Route::post('/register', 'User\Auth\RegisterController@register');
// Route::post('/password/confirm', 'User\Auth\ConfirmPasswordController@confirm');
// Route::post('/password/email', 'User\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::post('/password/reset', 'User\Auth\ResetPasswordController@reset')->name('password.update');

// Route::get('/home', 'HomeController@index')->name('home');
