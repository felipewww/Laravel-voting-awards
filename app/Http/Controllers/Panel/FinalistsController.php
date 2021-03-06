<?php

namespace App\Http\Controllers\Panel;

use App\Categories;
use App\Finalists;
use App\Library\DataTablesExtensions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinalistsController extends Controller
{
    use DataTablesExtensions;
    public $model;

    public $total = 3;

    public function __construct()
    {
        parent::__construct();
        $this->vars->title = "Finalistas";
        $this->model = new Finalists();
    }

    public function index()
    {
        //Habilitar apenas categoiras que ainda não tenham 3 indicados
        $t = Categories::with(['Finalists'])->get();

        $enabled = [];
        foreach ($t as $cat){
            if ($cat->Finalists()->count() < $this->total) {
                array_push($enabled, $cat);
            }
        }

        $this->vars->categories = $enabled;

        //Todos os Finalistas
        $this->vars->finalists = Finalists::all();
        $this->dataTablesInit();

        return view('dash.finalists', ['vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function dataTablesConfig()
    {
        $data = [];
        foreach ($this->vars->finalists as $reg)
        {
            $newInfo =
                [
                $reg->id,
                $this->JSONparse($reg->name),
                $this->categorieName($reg->Categorie->name),
                $reg->Votes()->count(),
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-users m-l-10 has-tooltip',
                                    'href' => '/panel/finalista/'.$reg->id.'/users',
                                    'title' => 'Todos os votos'
                                ],
                            ],
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'ID'],
            ['title' => 'Indicado'],
            ['title' => 'Categoria'],
            ['title' => 'Votos'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }

    public function store(Request $request)
    {
        //dd('TODO', $request->all());
        $this->model->name = $this->JSONparse($request->name);
        $this->model->categorie_id = $request->categorie;
        $this->model->save();

        return redirect('/panel/finalistas');
    }

    public function vote(Request $request, $id)
    {

    }

    public function users(Request $request, $id)
    {
        $this->finalistInfo = $this->model->where('id', $id)->first();
        $this->methodConfigName = 'dataTablesFinalistUsers';

        $this->dataTablesInit();

        return view('dash.finalists_votes', ['vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function dataTablesFinalistUsers()
    {
        $data = [];
        foreach ($this->finalistInfo->Votes as $reg)
        {
            $newInfo = [
                $reg->User->id,
                $this->JSONparse($reg->User->name),
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-info m-l-10 has-tooltip',
                                    'href' => '/panel/finalistas/user/'.$reg->User->id.'/votos',
                                    'title' => 'Todos os votos'
                                ],
                            ],
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'ID'],
            ['title' => 'Nome'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }
}
