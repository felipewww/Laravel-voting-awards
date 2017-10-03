<?php

namespace App\Http\Middleware;

use App\Application;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
        if(Application::Info()->status == 'waiting'){
            Redirect::to('/finalistas')->send();
        }

        if(Application::Info()->status == 'finished'){
            Redirect::to('/vencedores')->send();
        }

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
