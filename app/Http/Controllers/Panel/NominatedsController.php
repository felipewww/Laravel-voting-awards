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

    public function dataTablesAguardando()
    {
        $data = [];
        foreach (Nominateds::where('valid', 0)->get() as $reg)
        {
            $newInfo = [
                $reg->id,
                $reg->name,
                $reg->User->id,
                $reg->User->name,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => ['class' => 'btn btn-success btn-circle fa fa-check m-l-10', 'href' => 'aprovar('.$reg->id.','.$reg->User->id.')']
                            ],
                            [
                                'html' => '',
                                'attributes' => ['class' => 'btn btn-danger btn-circle fa fa-times m-l-10', 'href' => 'reprovar('.$reg->id.','.$reg->User->id.')']
                            ]
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => ' ','width' => '30px'],
            ['title' => 'Indicado'],
            ['title' => ' ', 'width' => '30px'],
            ['title' => 'User'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }
}
