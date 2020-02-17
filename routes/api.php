<?php

use Illuminate\Http\Request;

Route::get('test', function(){ return "OK";});
Route::get('test/route',['uses' => 'MainController@test']);
Route::get('tickets',['uses' => 'MainController@tickets']);
Route::post('ticket',['uses' => 'MainController@createTicket']);
Route::post('near-branches',['uses' => 'MainController@nearestBranches']);


Route::post('upload',['uses' => 'MainController@uploadFile']);
