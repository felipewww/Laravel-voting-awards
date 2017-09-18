<?php

namespace App\Http\Controllers\Panel;

use App\Application;
use App\Library\DataTablesExtensions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{
    use DataTablesExtensions;

    public $vars;
    public $model;
    public $status = [
        'ellection' => 'Indicação',
        'voting' => 'Votação',
        'finished' => 'Finalizada'
    ];

    public function __construct()
    {
        parent::__construct();
        $this->vars = new \stdClass();
        $this->vars->title = "Finalistas";
        $this->vars->status = $this->status;
        $this->model = new Application();
        $this->model = $this->model->first();
    }

    public function changeStatus(Request $request)
    {
        $this->model->status = $request->status;
        $this->model->save();
        return redirect('/panel/app');
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
                    $reg->name,
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
