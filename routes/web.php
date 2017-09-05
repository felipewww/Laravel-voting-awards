<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LoginController@index');
Route::get('/registro', 'RegisterController@index');
Route::post('/registro', 'RegisterController@save');

Route::get('/login/{from}/{token}', 'LoginController@login');
Route::get('/sobre', function (){
    return view('sobre');
});

//Route::any('/entrar', function(){
//    return view('login');//'Ir para a tela de login antes!';
//});


Route::post('/login', 'LoginController@login');

Route::group(['middleware' => 'OwnAuth', 'prefix' => 'indicacao'], function($request){
    Route::get('/', 'EllectionController@index');
    Route::get('/termos', 'EllectionController@termos');
    Route::post('/envia', 'EllectionController@recebe');
    Route::get('/agree', 'EllectionController@agree');
});