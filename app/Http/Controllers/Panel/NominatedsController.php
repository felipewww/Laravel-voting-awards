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
        return view('dash.nominateds', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

//    public function validos()
//    {
//        $this->dataTablesInit();
//        return view('dash.nominateds', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
//    }

    public function dataTablesAguardando()
    {
        $data = [];
        foreach (Nominateds::where('valid', 0)->get() as $reg)
        {
            $newInfo = [
                $reg->name,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => ['class' => 'btn btn-warning btn-circle fa fa-pencil m-l-10', 'href' => '#']
                            ],
                            [
                                'html' => '',
                                'attributes' => ['class' => 'btn btn-danger btn-circle fa fa-trash m-l-10 modal-delete', 'data-toggle'=>'modal', 'data-target' => '#modalDelete']
                            ]
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'Nome'],
            ['title' => 'Actions', 'width' => '150px'],
        ];
    }

//    public function dataTablesConfig()
//    {
//        $data = [];
//        foreach (Nominateds::where('valid', 1)->get() as $reg)
//        {
//            $newInfo = [
//                $reg->name,
//                $reg->categorie_name,
//                $reg->total,
//                [
//                    'rowActions' =>
//                        [
//                            [
//                                'html' => '',
//                                'attributes' => ['class' => 'btn btn-warning btn-circle fa fa-pencil m-l-10', 'href' => '#']
//                            ],
//                            [
//                                'html' => '',
//                                'attributes' => ['class' => 'btn btn-danger btn-circle fa fa-trash m-l-10 modal-delete', 'data-toggle'=>'modal', 'data-target' => '#modalDelete']
//                            ]
//                        ]
//                ]
//            ];
//
//            array_push($data, $newInfo);
//        }
//
//        $this->data_info = $data;
//        $this->data_cols = [
//            ['title' => 'Indicado'],
//            ['title' => 'Categoria'],
//            ['title' => 'Votos'],
//            ['title' => 'Actions', 'width' => '150px'],
//        ];
//    }
}
