<?php

namespace App\Http\Controllers\Panel;

use App\Application;
use App\Categories;
use App\Finalists;
use App\Library\DataTablesExtensions;
use App\PreFinalists;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    use DataTablesExtensions;

    public $model;
    public $status = [
        'ellection' => 'Indicação',
        'prevote' => '10 finalistas',
        'voting' => 'Votação',
        'finished' => 'Finalizada'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->vars->title = "Finalistas";
        $this->vars->status = $this->status;
        $this->model = new Application();
        $this->model = $this->model->first();
    }

    public function changeStatus(Request $request)
    {
        $go = [
            'error'     => false,
            'message'   => ''
        ];

        switch ($request->status)
        {
            case 'prevote':
                $go = $this->__toPreVote();
                break;

            case 'voting':
                $go = $this->__toVoting();
                break;
        }

        if ($go['error']) {
            $this->vars->title = 'Ação não permitida';

            return view('dash.unable', [
                'vars' => $this->vars,
                'message' => $go['message']
            ]);
        }

        $this->model->status = $request->status;

        $this->model->save();
        return redirect('/panel/app');
    }

    protected function __toPreVote()
    {
        $res = [
            'error'     => false,
            'message'   => ''
        ];

        if (env('APP_ENV') == 'production')
        {
            $ctrl = new PreFinalistsController();
            $required = ($ctrl->total * Categories::all()->count());

            if ( PreFinalists::all()->count() < $required )
            {
                $res['error'] = true;
                $res['message'] = 'Cadastre os '.$required.' pré finalistas necessários antes de alterar o status.';
            }
        }

        return $res;
    }

    protected function __toVoting()
    {
        $res = [
            'error'     => false,
            'message'   => ''
        ];

        if (env('APP_ENV') == 'production')
        {
            $ctrl = new FinalistsController();
            $required = ($ctrl->total * Categories::all()->count());

            if ( Application::Info()->status != 'prevote' )
            {
                $res['error'] = true;
                $res['message'] = 'Não é permitido ir para FINALISTAS antes da PRÉ VOTAÇÃO de finalistas.';
            }

            if ( Finalists::all()->count() < $required )
            {
                $res['error'] = true;
                $res['message'] = 'Cadastre os '.$required.' finalistas necessários antes de alterar o status.';
            }
        }

        return $res;
    }

    public function index()
    {
        $this->dataTablesInit();

        return view(
            'dash.application', [
                'vars' => $this->vars,
                'app' => $this->model,
                'dataTables' => $this->dataTables
            ]
        );
    }

    public function dataTablesConfig()
    {
        $usersModel = new User();

        $data = [];
        foreach ($usersModel->where('voteable',1)->get() as $reg)
        {
            $newInfo =
                [
                    $reg->id,
                    $this->JSONparse($reg->name),
                    $reg->Votes->count(),
                    [
                        'rowActions' =>
                            [
                                [
                                    'html' => '',
                                    'attributes' => [
                                        'class' => 'btn btn-custom btn-circle fa fa-info m-l-10 has-tooltip',
                                        'href' => '/panel/finalistas/user/'.$reg->id.'/votos',
                                        'title' => 'Todos os votos'
                                    ],
                                ],
                            ]
                    ]
                ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'ID'],
            ['title' => 'Nome'],
            ['title' => 'Votos'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }
}
