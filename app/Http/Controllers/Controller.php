<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static $FB_APP_ID;

    public function __construct()
    {
        //Obrigar o usuario a se logar toda vez que entrar no site. O facebook é deslogado via JS
//        if (Auth::check()) {
//            Auth::logout();
//        }

//        dd(env('APP_ENV'));
        Controller::$FB_APP_ID = (env('APP_ENV') == 'local') ? '139520189890905' : 'APP_PROD';
    }
}
