<?php

namespace App\Http\Controllers\Panel;

use App\Library\DataTablesExtensions;
use App\Nominateds;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use DataTablesExtensions;
    public $model;
    public $user;

    public function __construct()
    {
//        $p = bcrypt('ABSawards17');
//        dd($p);
        parent::__construct();
        $this->model = new User();
    }

    public function deleteVoto(Request $request, $id)
    {
        $response = [
            'status' => false
        ];

        try{
            $nominated = Nominateds::where('id', $id)->first();

            DB::beginTransaction();

            $nominated->user_id_delete = Auth::user()->id;
            $nominated->save();

            $nominated->delete();

            DB::commit();
            $response['status'] = true;
        }catch (\Exception $e){

            DB::rollBack();
            $response['message'] = 'Impossível deletar';
        }


        return json_encode($response);
    }

    public function info(Request $request, $id)
    {
        $user = $this->model->where('id', $id)->first();

        if (!$user) {
            throw new \Error('User not found');
        }

        $this->vars->title = 'Nomeações de '.$user->name;
        $this->methodConfigName = 'dataTablesUserNominateds';
        $this->user = $user;

        $this->dataTablesInit();

        return view('dash.user', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    //Indicados na primeira etapa
    public function dataTablesUserNominateds()
    {
        //$2y$10$PWCXIB5VSd03rchd7g6UjuGx8mqJU2pKfwnIAa4F9KxLwyERsCY7a

//        $p = bcrypt('S3nh4P4dr40');
//        dd( $p );
        $data = [];
//        dd($this->user);
        foreach ($this->user->Nominateds as $reg)
        {
            $status = $this->nominatedStatus($reg->valid);

            $ref = $this->cutReference($reg->reference);

            $newInfo = [
                $reg->id,
                $this->JSONparse($reg->name),
                $this->categorieName($reg->Categorie->name),
                $ref->reference,
                $status,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-success btn-circle fa fa-check m-l-10 has-tooltip',
                                    'href' => '#',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'data-voteid' => $reg->id,
                                    'data-alterto' => 1,
                                    'data-keep' => 3, //manter TR e alterar texto
                                    'title' => 'Aprovar'
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-danger btn-circle fa fa-times m-l-10 has-tooltip',
                                    'href' => '#',
                                    'data-jslistener-click' => 'Script._alterStatus',
                                    'data-voteid' => $reg->id,
                                    'data-alterto' => 2,
                                    'data-keep' => 3, //manter TR e alterar texto
                                    'title' => 'Anular'
                                ]
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-warning btn-circle fa fa-fire m-l-10 has-tooltip',
                                    'href' => '#',
                                    'data-jslistener-click' => 'Script._delete',
                                    'data-voteid' => $reg->id,
                                    'title' => 'Deletar'
                                ]
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => $ref->class,
                                    'href' => '#',
                                    'data-ref' => $reg->reference,
                                    'data-ref-col' => 3
                                ]
                            ]
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
            ['title' => 'Referência'],
            ['title' => 'Status'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }

    public function all(Request $request)
    {
        $this->vars->title = 'Participantes';
        $this->methodConfigName = 'dataTablesAllUsers';

        $this->dataTablesInit();

        return view('dash.allusers', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function dataTablesAllUsers()
    {
        $data = [];
        foreach (User::all() as $reg)
        {
//            $status = $this->nominatedStatus($reg->valid);
            $from = $this->getUserFrom($reg);

            $newInfo = [
                $reg->id,
                $this->JSONparse($reg->name),
                $reg->Nominateds()->count(),
                $reg->ip,
                $reg->email,
                $from,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-success btn-circle fa fa-info m-l-10 has-tooltip',
                                    'href' => '/panel/user/'.$reg->id,
                                    'title' => 'Informações do usuário'
                                ],
                            ],
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-facebook m-l-10 has-tooltip',
                                    'href' => ($reg->fb_link) ? $reg->fb_link : 'javascript:return;',
                                    'target' => '_blank'
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
            ['title' => 'Nome'],
            ['title' => 'Total indicados'],
            ['title' => 'IP'],
            ['title' => 'email'],
            ['title' => 'Via'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }

    public function votes(Request $request, $id)
    {
        $this->methodConfigName = 'dataTablesUserVotes';

        $this->user = $this->model->where("id", $id)->first();
        $this->vars->title = 'Votos de '.$this->user->name;

        $this->dataTablesInit();

        return view('dash.allusers', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    //Votos finais
    public function dataTablesUserVotes()
    {
        $data = [];
        foreach ($this->user->Votes as $reg)
        {
            $newInfo = [
                $reg->Finalist->name,
                $this->categorieName($reg->Finalist->Categorie->name),
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-success btn-circle fa fa-flag m-l-10 has-tooltip',
                                    'href' =>  '/panel/finalista/'.$reg->Finalist->id.'/users',
                                    'title' => 'Informações do Finalista'
                                ],
                            ],
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'Nome'],
            ['title' => 'Categoria'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }

    public function prevotes(Request $request, $id)
    {
        $this->methodConfigName = 'dataTablesUserPreVotes';

        $this->user = $this->model->where("id", $id)->first();
        $this->vars->title = 'Votos de '.$this->user->name;

        $this->dataTablesInit();

        return view('dash.allusers', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    //Votos finais
    public function dataTablesUserPreVotes()
    {
        $data = [];
        foreach ($this->user->PreVotes as $reg)
        {
            $newInfo = [
                $reg->Finalist->name,
                $this->categorieName($reg->Finalist->Categorie->name),
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-success btn-circle fa fa-flag m-l-10 has-tooltip',
                                    'href' =>  '/panel/prefinalista/'.$reg->Finalist->id.'/users',
                                    'title' => 'Informações do Finalista'
                                ],
                            ],
                        ]
                ]
            ];

            array_push($data, $newInfo);
        }

        $this->data_info = $data;
        $this->data_cols = [
            ['title' => 'Nome'],
            ['title' => 'Categoria'],
            ['title' => 'Ações', 'width' => '100px'],
        ];
    }
}
