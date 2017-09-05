<?php

namespace App\Http\Controllers;

use App\Mail\RegisterFormMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('register');
    }

    public function save(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        $a = substr(sha1($request->email), 0, 20);
        $b = substr(sha1($request->email), 20);
        $x = substr(sha1(microtime()),0 , 5);
        $token = $a.$x.$b;

        if ($user){
            $user->mail_token = $token;
        }else{
            $user = new User();

            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->password     = bcrypt('$request->password');
            $user->ip           = $request->ip();
            $user->mail_token   = $token;
            $user->agreed       = 0;
        }


        //Erro ao cadastrar usuário
        try{
            $user->save();
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['userError' => 'Erro ao cadastrar usuário.']);
        }

        //Erro ao enviar e-mail
        try{
            Mail::to($user)->send(new RegisterFormMail($user));
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['userError' => 'Impossível enviar o e-mail para login']);
        }

        return redirect('/')->withErrors(['register' => 'Um e-mail foi enviado com link para login. Lembre-se de verificar sua caixa de spam']);
    }
}
