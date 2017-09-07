<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
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
        if ( !Auth::check() ) {
            return redirect('/adm');
        }

        if ( Auth::user()->type != 'adm' ){
            //TODO - salvar na tabela de ações estranhas!
            Auth::logout();
            return redirect('/');
        }

        return $next($request);
    }
}
