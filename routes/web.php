<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'AdminAuth', 'prefix' => 'panel'], function($request){

    Route::get('/error', function (\Illuminate\Http\Request $request){
        return view('unable');
    });

    Route::get('/', 'Panel\DashboardController@index');

    Route::post('/app/status', 'Panel\ApplicationController@changeStatus');

    Route::get('/ips', 'Panel\IpsController@index');
    Route::get('/ips/byuser/{ip}', 'Panel\IpsController@byUser');

    Route::get('/aguardando', 'Panel\NominatedsController@aguardando');
    Route::get('/rejeitados', 'Panel\NominatedsController@rejeitados');

    Route::get('/users', 'Panel\UserController@all');
    Route::get('/user/{id}', 'Panel\UserController@info');
    Route::post('/user/deletevoto/{id}', 'Panel\UserController@deletevoto');

    Route::post('/alter/vote', 'Panel\NominatedsController@alterStatus');
    Route::get('/users/indicado/{nominated_id}/{cat_id}', 'Panel\NominatedsController@users');

    //Pré Finalistas
    Route::get('/prefinalistas', 'Panel\PreFinalistsController@index');
    Route::post('/prefinalista/store', 'Panel\PreFinalistsController@store');
    Route::get('/prefinalista/{id}/users', 'Panel\PreFinalistsController@users');
    Route::get('/prefinalistas/user/{id}/votos', 'Panel\UserController@prevotes');

    //finalistas
    Route::get('/finalistas', 'Panel\FinalistsController@index');
    Route::post('/finalista/store', 'Panel\FinalistsController@store');

    Route::get('/finalista/{id}/users', 'Panel\FinalistsController@users');
    Route::get('/finalistas/user/{id}/votos', 'Panel\UserController@votes');


    Route::get('/app', 'Panel\ApplicationController@index');
});

Route::get('/', 'LoginController@index');
Route::get('/fim', 'EllectionController@end');
Route::get('/registro', 'RegisterController@index');
Route::post('/registro', 'RegisterController@save');

Route::get('/login/{from}/{token}', 'LoginController@login');
Route::get('/sobre', function (){
    return view('sobre');
});

Route::get('/seguranca', function (){
    return view('seguranca');
});

Route::get('/regulamento', function (){
    return view('regulamento');
});

Route::post('/login', 'LoginController@login');
Route::any('/share/{catid}/{email_token}', 'EllectionController@share');

Route::group(['middleware' => 'OwnAuth', 'prefix' => 'indicacao'], function($request){
    Route::get('/', 'EllectionController@index');
    Route::get('/termos', 'EllectionController@termos');
    Route::post('/envia', 'EllectionController@recebe');
    Route::get('/agree', 'EllectionController@agree');

    Route::post('/vote', 'EllectionController@vote');
});

Route::get('/adm', function (){
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect('/panel');
    }else{
        return view('dash.login');
    }
});

Route::post('/adm/login', 'LoginController@adminLogin');