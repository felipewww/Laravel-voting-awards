<?php

namespace App\Http\Middleware;

use App\Application;
use App\Http\Controllers\Controller;
use Closure;
use Illuminate\Support\Facades\Redirect;

class AppStatus
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

        return $next($request);
    }

}
