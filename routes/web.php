<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LoginController@index');
Route::get('/registro', 'RegisterController@index');
Route::post('/registro', 'RegisterController@save');

Route::any('/entrar', function(){
//    $user = \App\User::find(1)->first();
//    \Illuminate\Support\Facades\Auth::login($user);
    return view('login');//'Ir para a tela de login antes!';
});

Route::post('/login', 'LoginController@login');

Route::group(['prefix' => 'indicacao', 'middleware' => 'OwnAuth'], function($request){
    Route::get('/', 'EllectionController@index');
});