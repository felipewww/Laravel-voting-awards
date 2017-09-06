<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Nominateds;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EllectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (Auth::user()->agreed == "0") {
            return redirect('/indicacao/termos');
        }

        $user = Auth::user();
        $info = [];

        //Json para falar com JS
        foreach (Categories::all() as $cat)
        {
            $t = $user->Nominateds()->where('categorie_id', $cat->id)->first();

            $info[$cat->position] = [];
            $info[$cat->position]['name']       = $cat->name;
            $info[$cat->position]['id']         = $cat->id;
            $info[$cat->position]['nominated']  = null;

            if ($t) {
                $info[$cat->position]['nominated'] = ['name' => $t->name, 'reference' => $t->reference];
            }
        }

        $vars = new \stdClass();
        $vars->cats = Categories::all();
        $vars->info = $info;
        $vars->rand = rand(100,200); //forçar navegadores a limpar o cache

        return view('ellection', ['v' => $vars ]);
    }

    public function recebe(Request $request)
    {
        $response = [
            'status' => false
        ];

        $cat_id = (int)$request->cat;

        $alreadyNominated = Auth::user()->Nominateds()->where('categorie_id', $cat_id)->first();
        if ($alreadyNominated) {
            $response['message'] = 'Você já votou nessa categoria';
            return json_encode($response);
        }

        $v = Validator::make($request->input(),[
            'name' => 'not_in:Indicado|required|min:3|max:45',
            'ref' => 'not_in:Referência|required|min:5|max:255'
        ]);

        if ( $v->fails() ){
            $response['message'] = 'Preencha todos os campos corretamente.';
            return json_encode($response);
        }

        $new = new Nominateds();
        $new->name          = $request->name;
        $new->reference     = $request->ref;
        $new->categorie_id  = $cat_id;
        $new->user_id  = Auth::user()->id;

        if (Auth::user()->fb_id) {
            $new->valid = 1;
        }

        try{
            $new->save();
        }catch (\Exception $e){
            $response['message'] = 'Erro ao votar. tenta novamente';
            return json_encode($response);
        }

        $response['status'] = true;
        return json_encode($response);
    }

    public function termos()
    {
        return view('termos');
    }

    public function agree()
    {
        $response = [
            'status' => false
        ];

        try{
            $response['status'] = true;

            Auth::user()->agreed = 1;
            Auth::user()->save();

        }catch (\Exception $e){
            $response['status'] = false;
        }

        return json_encode($response);
    }

    public function share(Request $request, $catid, $name){
        $cat = Categories::where('id', $catid)->first();

        return view('share', [
            'image_name' => $cat->image_name,
            'cat_id' => $catid,
            'cat_name' => $cat->name,
            'name' => $name
        ]);
    }
}
