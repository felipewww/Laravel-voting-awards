<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {

    }

    public function nominatedStatus($dbstatus)
    {
        switch ($dbstatus)
        {
            case 0:
                $status = 'Aguardando';
                break;

            case 1:
                $status = 'Válido';
                break;

            case 2:
                $status = 'Cancelado';
                break;

            default:
                throw new \Error('Status inválido');
                break;
        }

        return $status;
    }

    public function getUserFrom(User $user)
    {
        if ($user->fb_id)
        {
            $from = 'Facebook';
        }
        else
        {
            $from = 'Formulário';
        }

        return $from;
    }
}
