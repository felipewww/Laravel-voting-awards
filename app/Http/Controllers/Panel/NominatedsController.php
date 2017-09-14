<?php

namespace App\Http\Controllers\Panel;

use App\Library\DataTablesExtensions;
use App\Nominateds;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NominatedsController extends Controller
{
    use DataTablesExtensions;
    public $vars;

    public function __construct()
    {
        parent::__construct();
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

    public function dataTablesAguardando()
    {
        $data = [];
        foreach (Nominateds::where('valid', 0)->get() as $reg)
        {
            $newInfo = [
                $reg->id,
                $reg->name,
                $reg->Categorie->name,
//                [
//                    'Link' =>
//                        [
//                            [
//                                'html' => $reg->User->name,
//                                'attributes' => ['href' => '/panel/user/'.$reg->User->id]
//                            ],
//                        ]
//                ],
                $reg->User->name,
                $reg->User->ip,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-eye m-l-10 has-tooltip',
//                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'href' => '/panel/user/'.$reg->User->id,
                                    'title' => 'Todos os votos'
//                                    'data-voteid' => $reg->Categorie->id,
//                                    'data-alterto' => 2
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-success btn-circle fa fa-check m-l-10 has-tooltip',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'href' => '#',
                                    'data-voteid' => $reg->Categorie->id,
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
                                    'data-voteid' => $reg->Categorie->id,
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
}
