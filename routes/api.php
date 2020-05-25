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

Route::namespace('Api')->group(function(){
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    // Legacy API
    Route::prefix('legacy')->group(function () {
        Route::get('/dictionary', 'LegacyController@dictionary')->name('api.legacy.dictionary');
        Route::get('/search', 'LegacyController@search')->name('api.legacy.search');
    });

});

Route::namespace('Api\v1')->prefix('v1')->group(function(){
    // Route::middleware('auth:api')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::get('/groups', 'GroupController@list')->name('api.v1.groups');
    // Authentication
    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', 'AuthController@login')->name('api.v1.auth.login');
        Route::post('signup', 'AuthController@signup')->name('api.v1.auth.signup');

        Route::group([
            'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', 'AuthController@logout')->name('api.v1.auth.logout');
            Route::get('me', 'AuthController@user')->name('api.v1.auth.me');
        });
    });

});


