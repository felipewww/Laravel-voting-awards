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
            ->select('nominateds.name', DB::raw('SUM(1) as total'), 'categories.name AS categorie_name', 'categories.id AS categorie_id')
            ->groupBy('nominateds.name','nominateds.categorie_id')
            ->orderBy(DB::raw('total'), 'DESC')
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
                                'html'          => '',
                                'attributes'    => [
                                    'class'     => 'btn btn-success btn-circle fa fa-users m-l-10 has-tooltip',
                                    'href'      => '/panel/users/indicado/'.$reg->name.'/'.$reg->categorie_id,
                                    'title'     => 'Ver usuários'
                                ]
                            ],
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
            ['title' => 'Ações', 'width' => '70px'],
        ];
    }
}
