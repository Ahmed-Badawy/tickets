<?php

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

//Route::get('test-email',function(){return "OK";});

Route::get('test-email',['uses' => 'Admin\HomeController@test']);

Route::group(['middleware' => ['cors'],'namespace' => 'Admin', 'as' =>'admin.api.'], function(){

    // Route::get('maximo/vendors',['uses' => 'ExternalAPIs@getVendors']);

    /*Route::group(['middleware' => 'auth:admin_api'], function(){
        Route::get('me', ['as' => 'user.me', 'uses' => 'UserController@me']);
    });*/

    Route::post('login',['as' => 'admin_api.login', 'uses' => 'HomeController@login']);

    Route::group(['middleware' => ['auth:admin_api']], function(){
    //Route::group([], function(){

        # ================================== #
        # =========== POST ROUTES ========== #
        # ================================== #
        Route::post('search',['uses' => 'HomeController@search']);
      
        # ================================== #
        # =========== GET ROUTES =========== #
        # ================================== #
        Route::get('dashboard-info',['as' => 'dashboard.info', 'uses' => 'HomeController@dashboard']);
       
        # ================================== #
        # =========== DELETE ROUTES ======== #
        # ================================== #
        Route::delete('email-template/{template_id}',['uses' => 'HomeController@deleteEmailTemplate']);
       
        # ================================== #
        # =========== PUT ROUTES =========== #
        # ================================== #
        Route::put('email-template/{id}',['uses' => 'HomeController@editEmailTemplate']);
       
    });
});
