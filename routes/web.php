<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'LoginController@index');
Route::get('/registro', 'RegisterController@index');
Route::post('/registro', 'RegisterController@save');

Route::get('/login/{from}/{token}', 'LoginController@login');
Route::get('/sobre', function (){
    return view('sobre');
});

Route::get('/seguranca', function (){
    return view('seguranca');
});

//Route::any('/share/{catid}/{name}', 'EllectionController@share');

//Route::get('/termos', function (){
//    return view('termos');
//});

Route::post('/login', 'LoginController@login');
Route::any('/share/{catid}/{email_token}', 'EllectionController@share');

Route::group(['middleware' => 'OwnAuth', 'prefix' => 'indicacao'], function($request){
    Route::get('/', 'EllectionController@index');
    Route::get('/termos', 'EllectionController@termos');
    Route::post('/envia', 'EllectionController@recebe');
    Route::get('/agree', 'EllectionController@agree');
});

Route::get('/adm', function (){
//dd(\Illuminate\Support\Facades\Auth::check());
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/panel');
    }else{
        return view('dash.login');
    }
});

Route::post('/adm/login', 'LoginController@adminLogin');

Route::group(['middleware' => 'AdminAuth', 'prefix' => 'panel'], function($request){

    Route::get('/', 'Panel\DashboardController@index');
    Route::get('/ips', 'Panel\IpsController@index');
    Route::get('/ips/byuser/{ip}', 'Panel\IpsController@byUser');

    Route::get('/aguardando', 'Panel\NominatedsController@aguardando');
//    Route::get('/validos', 'Panel\NominatedsController@validos');

});