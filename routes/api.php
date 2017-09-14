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
//Route::group(['middleware' => 'AdminAuth', 'prefix' => 'panel'], function($request){
//
//    Route::any('/user/test/vote', function (\Illuminate\Http\Request $request){
//        dd($request->all());
//    });
//});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    dd('here!!!');
    return $request->user();
});
