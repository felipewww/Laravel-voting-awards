<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
//        dd(Auth::user());
//        Auth::logout();
//        return 'Got to dashboard!';
        return view('dash.main');
    }
}
