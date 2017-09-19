<?php

namespace App\Http\Controllers;

use App\User;
use App\WeirdTries;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
     * JS para testar hack de login com facebook, testar no metodo fbLogin() em Login.js
     *
    // data: { _token: window.csrfToken, user: response, from: 'fb', __token: __token }, //user editado
    // data: { _token: window.csrfToken, user: hack, from: 'fb', __token: __token_hack }, //token e user editado
    // data: { _token: window.csrfToken, user: response, from: 'fb', __token: __token_hack }, //token editado
     *
    var __token_hack = "AAABZB5JNbgVkBACpx72bVadC1Jg3ZBI3PDOwkBckcApOUcnghNHnFtqi0JTYTjKUxbl3pEZBx46MjBtZBoQtRnittplhtQAnrHqqRyETJ6bQXfFGEqZCTVVDq2nwZAoG8ZCndcMixsA3WAt5cJalysj7HyTtXJg0vDAazcSS5UKpw43ZBKCCeWZBfzVChPzrrleoI7ipXMSSNkQZDZD";
    var hack = {
    id: 158820864253198
    };
     */
    public function __construct(Request $request)
    {
        parent::__construct();
    }

    public function adminLogin(Request $request)
    {
        $user = User::where('username', $request->u)->first();

        if (!$user) {
            return redirect('/adm');
        }

        if ( !Hash::check($request->p, $user->password) ) {
            return redirect('/adm');
        }else{
            //password ok
            Auth::login($user);
            return redirect('/panel');
        }
    }

    public function index(Request $request)
    {
        //Obrigar o usuario a se logar toda vez que entrar no site. O facebook é deslogado via JS
        if (Auth::check()) {
            Auth::logout();
        }

        return view('login');
    }

    public function login(Request $request)
    {
        switch ($request->offsetGet('from'))
        {
            case 'fb':
                return $this->loginFacebook($request);
                break;

            case 'form':
                return $this->loginForm($request);
                break;

            default:
                return redirect('/');
                break;
        }
    }

    protected function loginFacebook(Request $request)
    {
        $response = [
            'status' => false
        ];

        //new Facebook()
        $fb = new \Facebook\Facebook([
            'app_id'                => env('FB_APP_ID'),
            'app_secret'            => env('FB_APP_SECRET'),
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);

        //Verifica se o TOKEN enviado está realmente registrado no facebook
        try{
            $validateUser = $fb->get('/me?fields=id,name', $request->__token);
        }catch (FacebookSDKException $e){
            $request->offsetSet('from', 'Not this time! ;)');
            $request->offsetSet('ip', $request->ip());

            //Salvar ação estranha e dados do request na tabela
            $weirdAction = new WeirdTries();
            $weirdAction->info_json = json_encode( $request->all() );
            $weirdAction->save();

            $response['msg'] = 'Not this time! ;)';
            return json_encode($response);
        }

        $fbid = $request->user['id'];

        //Verifica se o ID_FACEBOOK do usuario enviado é o mesmo do TOKEN_FACEBOK enviado
        if ( $validateUser->getDecodedBody()['id'] != $fbid ) {

            $info = [
                'from' => 'nice try! ;)',
                'ip' => $request->ip(),
                'request' => json_encode($request->all()), //aqui, as informações editadas enviadas
                'decode_body' => json_encode($validateUser->getDecodedBody()) //aqui o usuario que realmente esta logado
            ];

            //Salvar ação estranha e dados do request na tabela
            $weirdAction = new WeirdTries();
            $weirdAction->info_json = json_encode($info);
            $weirdAction->save();

            $response['msg'] = 'Nice try! ;)';
        }else{
            $response['status'] = true;

            try{
                $user = $this->setAndLogin($request, $fbid);
            }catch (\Exception $e){
                $response['message'] = 'Algo inesperado aconteceu!';
                $response['status'] = false;
            }

            $response['user'] = $user;
        }

        return json_encode($response);
    }

    public function loginForm(Request $request)
    {
        $token = $request->offsetGet('token');

        $user = User::where('mail_token', $token)->first();

        if (!$user) {
            return redirect('/')->withErrors(['notFound' => 'Acesso negado. Verifique o link enviado no seu e-mail ou tente reenviá-lo']);
        }

        Auth::login($user);

        return redirect('/indicacao');
    }

    public function setAndLogin(Request $request, $fbid) : User
    {
        $userRequest = $request->user;

        //Se o usuario ja se cadastrou via FORM com o mesmo e-mail, atualizar e retornar.
        $user = User::where('email', $userRequest['email'])->first();

        if ($user) {
            $user->name        = $userRequest['name'];
            $user->fb_id = $fbid;
            $user->fb_link     = $userRequest['link'];
//            $user->setError = 'just a test!'; //force error, let it commented
        }else{
            $user = User::where('fb_id', $fbid)->first();

            //Registrar no anco se ainda não for registrado...
            if (!$user) {
                $user              = new User();
                $user->name        = $userRequest['name'];
                $user->email       = $userRequest['email'];
                $user->fb_id       = $fbid;
                $user->type        = 'usr';
                $user->password    = 'default';
                $user->fb_link     = $userRequest['link'];
                $user->ip          = $request->ip();
                $user->agreed      = 0;
            }
        }

        try{
            $user->save();
        }catch (\Exception $e){
            abort(417, "Something went wrong");
        }

        Auth::login($user);
        return $user;
    }
}
