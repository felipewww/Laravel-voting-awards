<?php

namespace App\Http\Controllers\Panel;

use App\Library\DataTablesExtensions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    use DataTablesExtensions;
    public $vars;
    public $model;
    public $user;

    public function __construct()
    {
        parent::__construct();
        $this->vars = new \stdClass();
        $this->model = new User();
    }

    public function vote(Request $request)
    {
//        $res = [
//            'status' => true
////            'status' => false
//        ];
//        return json_encode($res);
        dd($request->all());
    }

    public function info(Request $request, $id)
    {
        $user = $this->model->where('id', $id)->first();

        if (!$user) {
            throw new \Error('User not found');
        }

        $this->vars->title = 'Votos de '.$user->name;
        $this->methodConfigName = 'dataTablesUserVotes';
        $this->user = $user;

        $this->dataTablesInit();

        return view('dash.user', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function dataTablesUserVotes()
    {
        $data = [];
//        dd($this->user);
        foreach ($this->user->Nominateds as $reg)
        {
            switch ($reg->valid)
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

            $newInfo = [
                $reg->id,
                $reg->name,
                $reg->Categorie->name,
                $status,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-success btn-circle fa fa-check m-l-10 has-tooltip',
                                    'href' => '#',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'data-voteid' => $reg->Categorie->id,
                                    'data-alterto' => 1,
                                    'data-keep' => 1, //manter TR e alterar texto
                                    'title' => 'Aprovar'
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-danger btn-circle fa fa-times m-l-10 has-tooltip',
                                    'href' => '#',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'data-voteid' => $reg->Categorie->id,
                                    'data-alterto' => 2,
                                    'data-keep' => 1, //manter TR e alterar texto
                                    'title' => 'Anular'
                                ]
                            ]
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'ID','width' => '30px'],
            ['title' => 'Indicado'],
            ['title' => 'Categoria'],
            ['title' => 'Status'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }
}
