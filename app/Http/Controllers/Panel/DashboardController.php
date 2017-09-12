<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Library\DataTablesExtensions;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    use DataTablesExtensions;
    public $vars;

    public function __construct()
    {
        parent::__construct();
        $this->vars = new \stdClass();
    }

    public function index()
    {
        $this->dataTablesInit();

        $this->vars->title = "Dashboard";

        return view('dash.home', ['vars' => $this->vars,'dataTables' => $this->dataTables]);
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
