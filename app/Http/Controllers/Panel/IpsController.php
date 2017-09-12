<?php

namespace App\Http\Controllers\Panel;

use App\Library\DataTablesExtensions;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IpsController extends Controller
{
    use DataTablesExtensions;
    public $vars;

    public function __construct()
    {
        $this->vars = new \stdClass();
        $this->vars->title = "Informações sobre IPs";
    }

    public function index()
    {
        $this->dataTablesInit();
        return view('dash.ips', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function byUser(Request $request, $ip)
    {
        $this->methodConfigName = 'dataTablesIpByUser';
        $this->dataTablesInit();
        return view('dash.ipsbyuser', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function dataTablesIpByUser()
    {
        $data = [];
        foreach (User::all() as $reg)
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

    public function dataTablesConfig()
    {
        $nominateds = DB::table('nominateds')
            ->join('categories', 'categories.id', '=', 'nominateds.categorie_id')
            ->select('nominateds.name', DB::raw('SUM(1) as total'), 'categories.name AS categorie_name')
            ->groupBy('nominateds.name','nominateds.categorie_id')
            ->orderBy(DB::raw('SUM(1)'), 'DESC')
            ->where('nominateds.valid','1')
            ->get();

        $data = [];
        foreach ($nominateds as $reg)
        {
            $newInfo = [
                $reg->name,
                $reg->categorie_name,
                $reg->total,
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
            ['title' => 'Indicado'],
            ['title' => 'Categoria'],
            ['title' => 'Votos'],
            ['title' => 'Actions', 'width' => '150px'],
        ];
    }
}
