<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class OwnAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check())
        {
            //Se a rota ja for "ENTRAR", nao redirecionar, apenas continua.
            if ( $request->route()->uri != 'entrar' ) {
                return redirect('/entrar');
            }else{
                return $next($request);
            }
        }
        else
        {
            //Verifica se o usuario logado realmente existe no banco
//            $confirmUser = User::where('id', Auth::user()->id)->first();
//            if (!$confirmUser) {
//                Auth::logout();
//                return redirect('/entrar');
//            }

            //Se a rota ja for "INDICAÇÃO", nao redirecionar, apenas continua.
            if ( $request->route()->uri != 'indicacao' ) {
                return redirect('/indicacao');
            }else{
                return $next($request);
            }
        }
    }
}
