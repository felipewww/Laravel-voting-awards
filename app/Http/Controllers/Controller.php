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
    public static $FB_APP_SECRET;

    public function __construct()
    {
        $secrets = [
            'dev' => '1f2409a8390689fd3614aef9089e8fdc',
            'staging' => 'TODO',
            'production' => 'TODO'
        ];

        Controller::$FB_APP_ID = (env('APP_ENV') == 'local') ? '139520189890905' : 'APP_PROD';
        Controller::$FB_APP_SECRET = (env('APP_ENV') == 'local') ? '1f2409a8390689fd3614aef9089e8fdc' : 'APP_SECRET_PROD';
    }
}
