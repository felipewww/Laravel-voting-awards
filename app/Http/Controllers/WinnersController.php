<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;

class WinnersController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        //Não permitir entrar se não estiver finalizado
        if (\App\Application::Info()->status != 'finished') {
            return redirect('/')->send();
        }
    }

    public function index(Request $request)
    {
        $vars = new stdClass();
        $vars->categories = \App\Categories::orderBy('position')->get();
        $vars->winners = \App\Winners::with('Categorie')->get();

        return view('fim', ['vars' => $vars ]);
    }

    public function _share(Request $request, $cat_id)
    {
        $model = new \App\Winners();
        $winner = $model->where('categorie_id', $cat_id)->first();

        return view('share_winner', [
            'name' => $winner->name,
            'cat_id' => $cat_id,
            'cat_name' => ucwords($this->categorieName($winner->Categorie->name)),
            'image_name' => $winner->Categorie->image_name,
        ]);
    }
}
