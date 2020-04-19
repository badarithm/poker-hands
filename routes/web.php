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
Route::group(['middleware' => ['web']], function() {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::group(['prefix' => 'auth'], function() {
        Route::post('login', 'AuthController@login')->name('login-action');
        Route::get('login', 'AuthController@show')->name('login');
        Route::match(['get', 'post'], 'logout', 'AuthController@logout')->name('logout');
    });

    Route::group(['middleware' => ['auth']], function() {
        Route::group(['prefix' => 'result-upload'], function() {
            Route::get('/', 'GameResultsUploadController@show')->name('result-upload-form');
            Route::post('/', 'GameResultsUploadController@uploadResults')->name('result-upload-action');
        });

        Route::group(['prefix' => 'dashboard'], function() {
            Route::get('/', 'DashboardController@index')->name('dashboard');
        });
    });
});
