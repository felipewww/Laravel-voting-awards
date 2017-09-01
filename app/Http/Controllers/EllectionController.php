<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EllectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
//        Auth::logout();
        $user = Auth::user();
        $nominateds = $user->Nominateds;

        $info = new \stdClass();
        foreach (Categories::all() as $cat)
        {
            $t = $user->Nominateds()->where('id', $cat->id)->first();

            echo '<pre>';

            if ($t){
                echo $t->name;
            }else{
                echo 'Nenhum indicado encontrado';
            }

            echo '</pre>';
        }

        $vars = new \stdClass();
        $vars->cats = Categories::all();
        $vars->nominateds = $nominateds;

        return view('ellection', ['v' => $vars ]);
    }
}
