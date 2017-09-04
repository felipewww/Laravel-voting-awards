<?php

namespace App\Http\Controllers;

use App\User;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Facebook\FacebookClient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
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
        switch ($request->from)
        {
            case 'fb':
                return $this->loginFacebook($request);
                break;

            case 'form':
                return $this->loginForm($request);
                break;

            default:
                return json_encode([
                    'status' => false
                ]);
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
            'app_id' => '139520189890905',
            'app_secret' => '1f2409a8390689fd3614aef9089e8fdc',
            'default_graph_version' => 'v2.10',
            //'default_access_token' => '{access-token}', // optional
        ]);

        //Verifica se o TOKEN enviado está realmente registrado no facebook
        try{
            $validateUser = $fb->get('/me?fields=id,name', $request->__token);
        }catch (FacebookSDKException $e){
            $response['msg'] = 'Not this time! ;)';
            return json_encode($response);
        }

        $fbid = (int)$request->user['id'];

        //Verifica se o ID_FACEBOOK do usuario enviado é o mesmo do TOKEN_FACEBOK enviado
        if ( (int)$validateUser->getDecodedBody()['id'] != $fbid ) {
            $response['msg'] = 'Nice try! ;)';
        }else{
            $response['status'] = true;
            $user = $this->setAndLogin($request, $fbid);
            $response['user'] = $user;
        }

        return json_encode($response);
    }

    public function loginForm(Request $request)
    {
        $response = [
            'status' => false
        ];

        return json_encode($response);
    }

    public function setAndLogin(Request $request, $fbid) : User
    {
        $user = User::where('fb_id', $fbid)->first();

        if (!$user) {
            $userRequest = $request->user;

            $user              = new User();
            $user->name        = $userRequest['name'];
            $user->email       = $userRequest['email'];
            $user->fb_id       = $fbid;
            $user->type        = 'usr';
            $user->password    = 'default';
            $user->fb_link     = $userRequest['link'];
            $user->ip          = $request->ip();
            $user->agreed      = 0;

//            dd($user);
            $user->save();
        }

        Auth::login($user);

//        dd('logging', $user);
//        if ($user) {
//        }

        return $user;
    }
}
