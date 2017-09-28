<?php

namespace App\Http\Controllers\Panel;

use App\Categories;
use App\Library\DataTablesExtensions;
use App\Nominateds;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NominatedsController extends Controller
{
    use DataTablesExtensions;
    public $nominatedsByUser;
    public $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Nominateds();
        $this->vars->title = "Indicados";
    }

    public function aguardando()
    {
        $this->methodConfigName = 'dataTablesAguardando';
        $this->dataTablesInit();
        $this->vars->title = "Aguardando aprovação";
        return view('dash.nominateds', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function alterStatus(Request $request)
    {
        $res = [
            'status' => false
        ];

        $nom = $this->model->where('id', $request->vote)->first();

        if ($nom)
        {
            //Não alterar nada se for o status atual, apenas retornar que foi alterado!
            if ($nom->valid == $request->to)
            {
                $res['status'] = true;
            }
            else
            {
                $nom->valid = $request->to;

                if ($request->to == 2) {
                    $nom->user_id_deny = Auth::user()->id;
                    $nom->why_deny = $request->motivo;
                }

                if($nom->save()){
                    $res['status'] = true;
                };
            }
        }

        return json_encode($res);
    }

    public function dataTablesAguardando()
    {
        $data = [];
        foreach (Nominateds::where('valid', 0)->get() as $reg)
        {
            $newInfo = [
                $reg->id,
                $reg->name,
                $reg->reference,
                $this->categorieName($reg->Categorie->name),
                $reg->User->name,
                $reg->User->ip,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-eye m-l-10 has-tooltip',
                                    'href' => '/panel/user/'.$reg->User->id,
                                    'title' => 'Todos os votos'
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-success btn-circle fa fa-check m-l-10 has-tooltip',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'href' => '#',
                                    'data-voteid' => $reg->id,
                                    'data-alterto' => 1,
                                    'title' => 'Aprovar'
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-danger btn-circle fa fa-times m-l-10 has-tooltip',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'href' => '#',
                                    'data-voteid' => $reg->id,
                                    'data-alterto' => 2,
                                    'title' => 'Anular'
                                ],
                            ],
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'ID','width' => '30px'],
            ['title' => 'Indicado'],
            ['title' => 'Referência'],
            ['title' => 'Categoria'],
            ['title' => 'User'],
            ['title' => 'IP'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }

    public function users(Request $request, $nominated, $cat_id)
    {
        $nominated = Nominateds::where('id', $nominated)->first();

        $this->methodConfigName = 'dataTablesUsers';

        $cat = Categories::where('id', $cat_id)->first();

        $this->vars->title = $nominated->name." | ". $this->categorieName($cat->name);
//        $this->nominatedsByUser = Nominateds::where('id', $nominated->id)->where('categorie_id', $cat->id)->get();
        $this->nominatedsByUser = Nominateds::where('name', $nominated->name)->where('categorie_id', $cat->id)->get();

        $this->dataTablesInit();

        return view('dash.nominateds', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }
    public function dataTablesUsers()
    {
        $data = [];

        foreach ($this->nominatedsByUser as $reg)
        {
            $status = $this->nominatedStatus($reg->valid);
            $from = $this->getUserFrom($reg->User);

            $newInfo = [
                $reg->id,
                $this->JSONparse($reg->User->name),
                $reg->reference,
                $reg->User->ip,
                $status,
                $from,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-facebook m-l-10 has-tooltip',
                                    'href' => ($reg->User->fb_link) ? $reg->User->fb_link : 'javascript:return;',
                                    'target' => '_blank'
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-eye m-l-10 has-tooltip',
                                    'href' => '/panel/user/'.$reg->User->id,
                                    'title' => 'Votos do usuário'
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-success btn-circle fa fa-check m-l-10 has-tooltip',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'href' => '#',
                                    'data-voteid' => $reg->id,
                                    'data-alterto' => 1,
                                    'title' => 'Aprovar',
                                    'data-keep' => 3
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-danger btn-circle fa fa-times m-l-10 has-tooltip',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'href' => '#',
                                    'data-voteid' => $reg->id,
                                    'data-alterto' => 2,
                                    'title' => 'Anular',
                                    'data-keep' => 3
                                ],
                            ],
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'ID','width' => '30px'],
            ['title' => 'User'],
            ['title' => 'Referência'],
            ['title' => 'IP'],
            ['title' => 'status'],
            ['title' => 'via'],
            ['title' => 'Ações', 'width' => '150px'],
        ];
    }

    public function rejeitados()
    {
        $this->methodConfigName = 'dataTablesRejeitados';
        $this->dataTablesInit();
        $this->vars->title = "Votos rejeitados";

        return view('dash.rejeitados', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function dataTablesRejeitados()
    {
        $data = [];
        foreach (Nominateds::where('valid', 2)->get() as $reg)
        {
            $newInfo = [
                $reg->id,
                $this->JSONparse($reg->name),
                $this->JSONparse($reg->why_deny),
                $this->JSONparse($reg->userDeny->name),
                $this->categorieName($reg->Categorie->name),
                $this->JSONparse($reg->User->name),
                $reg->User->ip,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-eye m-l-10 has-tooltip',
                                    'href' => '/panel/user/'.$reg->User->id,
                                    'title' => 'Indicações do usuário'
                                ],
                            ],
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'ID','width' => '30px'],
            ['title' => 'Indicado'],
            ['title' => 'Motivo'],
            ['title' => 'Quem'],
            ['title' => 'Categoria'],
            ['title' => 'User'],
            ['title' => 'IP'],
            ['title' => 'Ações', 'width' => '50px'],
        ];
    }

}
