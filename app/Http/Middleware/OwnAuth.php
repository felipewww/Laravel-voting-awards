<?php

namespace App\Http\Middleware;

use App\Application;
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
            if ( $request->route()->uri != '' ) {
                return redirect('/');
            }else{
                return $next($request);
            }
        }
        else
        {
            if (Application::Info()->status == 'voting' && !Auth::user()->voteable)
            {
                return redirect('/fim');
//                return view('ellection_end');

//                dd('Action not allowed');
            }

            //Se a rota ja for "INDICAÇÃO", nao redirecionar, apenas continua.
            if ( $request->route()->uri != 'indicacao' ) {
                return $next($request);
            }else{
                return $next($request);
            }
        }
    }
}
