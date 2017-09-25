<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Finalists;
use App\FinalistVotes;
use App\Nominateds;
use App\User;
use App\WeirdTries;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Psy\Util\Json;

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
        $infoFinalistas = [];

        //Json para falar com JS
        foreach (Categories::orderBy('position')->get() as $cat)
        {
            $t = $user->Nominateds()->where('categorie_id', $cat->id)->first();

            $info[$cat->position] = [];
            $info[$cat->position]['name']       = $cat->name;
            $info[$cat->position]['icon']       = $cat->image_name;
            $info[$cat->position]['id']         = $cat->id;
            $info[$cat->position]['nominated']  = null;

            if ($t) {
                $info[$cat->position]['nominated'] = [
                    'name' => $this->JSONparse($t->name),
                    'reference' => $this->JSONparse($t->reference)
                ];
            }
        }

        $crypt = new Crypt();

        $vars = new \stdClass();
        $vars->cats = Categories::all();
        $vars->info = json_encode($info, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);
        $vars->rand = rand(100,200); //forçar navegadores a limpar o cache
        $vars->share_token = Crypt::encrypt(Auth::user()->id.'|'.Auth::user()->email);
        $vars->appStatus = $this->app->status;
        $vars->infoFinalists = json_encode($infoFinalistas);

        if($this->app->status == 'finished')
        {
            dd('Aplicação finalizada! Fazer tela do fim.');
        }

        if ($this->app->status == 'voting' && !Auth::user()->voteable)
        {
            return view('ellection_end', ['v' => $vars ]);
        }
        else
        {
            foreach (Categories::all() as $cat)
            {
                $infoFinalistas[$cat->position] = [];
                $infoFinalistas[$cat->position]['name']       = $cat->name;
                $infoFinalistas[$cat->position]['id']         = $cat->id;
                $infoFinalistas[$cat->position]['voted']      = null;
                $infoFinalistas[$cat->position]['nominateds'] = [];
                foreach ($cat->Finalists as $finalistCat)
                {
                    if (Auth::user()->Votes()->where('finalist_id', $finalistCat->id)->first()){
                        $infoFinalistas[$cat->position]['voted'] = $finalistCat->id;
                    }

                    array_push($infoFinalistas[$cat->position]['nominateds'], [
                        'id' => $finalistCat->id,
                        'name' => $this->JSONparse($finalistCat->name),
                        'categorie_id' => $finalistCat->categorie_id,
                    ]);
                }
            }

            $vars->infoFinalists = json_encode($infoFinalistas, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE);

            return view('ellection', ['v' => $vars ]);
        }
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
            'name' => 'not_in:Indicado|required|min:1|max:45',
            'ref' => 'not_in:Referência|required|min:1|max:255'
        ]);

        if ( $v->fails() ){
            $response['message'] = 'Preencha todos os campos corretamente.';
            return json_encode($response);
        }

        $new = new Nominateds();
        $new->name          = $this->JSONparse($request->name);
        $new->reference     = $this->JSONparse($request->ref);
        $new->categorie_id  = $cat_id;
        $new->user_id  = Auth::user()->id;

        if (Auth::user()->fb_id) {
            $new->valid = 1;
        }

        try{
            $new->save();
        }catch (\Exception $e){
            $response['message'] = 'Erro ao votar. tente novamente';
            return json_encode($response);
        }

        $response['status'] = true;
        $response['totalVotes'] = Auth::user()->Nominateds()->count();
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

    public function share(Request $request, $catid, $share_token){

        try{
            $share_token = explode('|', Crypt::decrypt($share_token));
        }catch (\Exception $e){
            return redirect('/');
        }

        $u_id = (int) $share_token[0];
        $user = User::where('id', $u_id)->where('email', $share_token[1])->first();

        if (!$user) {
            return redirect('/');
        }

        $cat = Categories::where('id', $catid)->first();
        $nom = $user->Nominateds()->where('categorie_id', $catid)->first();

        if (!$nom){
            return redirect('/');
        };

        return view('share', [
            'image_name' => $cat->image_name,
            'cat_id' => $catid,
            'cat_name' => str_replace('|', " ", $cat->name),
//            'cat_name' => $cat->name,
            'name' => $nom->name
        ]);
    }

    public function vote(Request $request)
    {
        $response = [
            'status' => false
        ];

        if (!$request->id) {
            $response['message'] = 'Por favor, Selecione um indicado';
            return json_encode($response);
        }

        $voted = Finalists::where('id', $request->id)->first();
        $userVote = Auth::user()->Votes;

        foreach ($userVote as $nominated)
        {
            $finalist = $nominated->Finalist;
            if ($finalist->categorie_id == $voted->categorie_id)
            {
                $response['message'] = 'Vocẽ já votou nessa categoria';
                $response['nice_try'] = '=*';

                WeirdTries::makeAndSave([
                    'user'      => Auth::user()->id,
                    'from'      => 'voting',
                    'message'   => 'Tentando votar em categoria ja votada',
                    'request'   => json_encode($request->all())
                ]);

                return json_encode($response);
            }
        }

        try{
            $newvote = new FinalistVotes();
            $newvote->finalist_id = $voted->id;
            $newvote->user_id = Auth::user()->id;
            $newvote->save();

            $response['status'] = true;
            $response['voted_id'] = $voted->id;
        }catch (\Exception $e){
            $response['message'] = "Erro inesperado. Tente novamente.";
            $response['error'] = $e->getMessage();
        }

        return json_encode($response);
    }

    public function end(Request $request)
    {
        return view('ellection_end');
    }
}
