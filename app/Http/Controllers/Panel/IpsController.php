<?php

namespace App\Http\Controllers\Panel;

use App\Library\DataTablesExtensions;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IpsController extends Controller
{
    use DataTablesExtensions;
    public $vars;

    public $ip;

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
        $this->ip = $ip;

        $this->dataTablesInit();
        return view('dash.ipsbyuser', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function dataTablesIpByUser()
    {
        $data = [];
        foreach (User::where('ip', $this->ip)->get() as $reg)
        {
            $newInfo = [
                $reg->id,
                $reg->name,
                $reg->Nominateds()->count(),
                Carbon::parse($reg->created_at)->format('d/m/Y H:i:s'),
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
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'ID', 'width' => '30px'],
            ['title' => 'Nome'],
            ['title' => 'Votos'],
            ['title' => 'Data Registro', 'width' => '150px'],
//            ['title' => 'Actions', 'width' => '150px'],
        ];
    }

    public function dataTablesConfig()
    {
        $nominateds = DB::table('nominateds')
            ->select('users.ip', DB::raw('SUM(1) as total'))
            ->join('users', 'users.id', '=', 'nominateds.user_id')
            ->groupBy('users.ip')
            ->orderBy(DB::raw('SUM(1)'), 'DESC')
            ->get();

        $data = [];
        foreach ($nominateds as $reg)
        {
            $newInfo = [
                $reg->ip,
                $reg->total,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => ['class' => 'btn btn-primary btn-circle fa fa-users m-l-10', 'href' => '/panel/ips/byuser/'.$reg->ip.'']
                            ]
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'IP'],
            ['title' => 'Total'],
            ['title' => 'Actions', 'width' => '70px'],
        ];
    }
}
