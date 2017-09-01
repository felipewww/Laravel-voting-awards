<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'EllectionController@index');
Route::post('/', 'EllectionController@index');

Route::any('/entrar', function(){
    $user = \App\User::find(1)->first();
    \Illuminate\Support\Facades\Auth::login($user);
    return view('login');//'Ir para a tela de login antes!';
})->middleware('OwnAuth');
//->middleware('OwnAuth')

Route::group(['prefix' => 'indicacao', 'middleware' => 'OwnAuth'], function($request){

//    Route::get('/', function(){
//        dd(\Illuminate\Support\Facades\Auth::check());
//        \Illuminate\Support\Facades\Auth::logout();
//        return view('ellection');
//    });
    Route::get('/', 'EllectionController@index');

});