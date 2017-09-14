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
    public $vars;
    public $nominatedsByUser;
    public $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Nominateds();
        $this->vars = new \stdClass();
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
//        dd($request->all());
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
                $reg->Categorie->name,
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
            ['title' => 'Categoria'],
            ['title' => 'User'],
            ['title' => 'IP'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }

    public function users(Request $request, $nominated, $cat_id)
    {
        $this->methodConfigName = 'dataTablesUsers';

        $cat = Categories::where('id', $cat_id)->first();

        $this->vars->title = $nominated." | ".$cat->name;
        $this->nominatedsByUser = Nominateds::where('name', 'LIKE', $nominated)->where('categorie_id', $cat->id)->get();

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
                $reg->User->name,
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
            ['title' => 'IP'],
            ['title' => 'status'],
            ['title' => 'via'],
            ['title' => 'Ações', 'width' => '150px'],
        ];
    }

}
