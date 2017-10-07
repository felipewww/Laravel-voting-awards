<?php

namespace App\Http\Controllers\Panel;

use App\Categories;
use App\Library\DataTablesExtensions;
use App\Nominateds;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NominatedsController extends Controller
{
    use DataTablesExtensions;
    public $nominatedsByUser;
    public $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Nominateds();
        $this->vars->title = "Indicados";
    }

    public function aguardando()
    {
        $this->methodConfigName = 'dataTablesAguardando';
        $this->dataTablesInit();
        $this->vars->title = "Aguardando aprovação";
        return view('dash.nominateds', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function _aguardando()
    {
        $this->methodConfigName = 'dataTablesAguardando';
        $this->vars->title = "Aguardando aprovação";
        return view('dash.aguardando', [ 'vars' => $this->vars ]);
    }

    public function __TreatCategorie($cat)
    {
        $str = $this->categorieName($cat->name);
        return $str;
    }

    public function AjaxAguardando(Request $request)
    {
        $cols = [
            [
                'show_name'     => 'ID',
                'name'          => 'id'
            ],
            [
                'show_name'     => 'Indicado',
                'name'          => 'name'
            ],
            [
                'show_name'     => 'Referência',
                'name'          => 'reference'
            ],
            [
                'show_name'     => 'Categoria',
                'name'          => 'cat_name',
//                'treat_method'  => '__TreatCategorie',
//                'isRelation'    => true
            ],
            [
                'show_name'     => 'Usuário',
                'name'          => 'username',
            ],
            [
                'show_name'     => 'IP',
                'name'          => 'userip',
            ],
            [
                'show_name'     => 'Ações',
                'name'          => ['AguardandoActions']
            ],
        ];


        /*
         * Array
         * Items : Array
         * */
        $order_info         = $request->order[0];
        $order_column       = $cols[$order_info['column']];
        $order_orient       = $order_info['dir'];
        $order_descending   = ( $order_orient == 'asc' ) ? false : true;

        if ($request->draw == '1') {
            $order_column = $cols[1];
        }

        $isRelationColumn = ( isset($order_column['isRelation']) ) ? $order_column['isRelation'] : false;

        /*
         * String
         * */
        $start      = $request->start;
        $length     = $request->length;

        /*
         * @item value
         * @item regex : false
         * */
        $search = $request->search['value'];

        $query = Nominateds::with(['Categorie','User'])->where('valid', 0);
        $queryCols = ['nominateds.*','categories.name AS cat_name', 'users.ip AS userip','users.name AS username'];

//        $query->addSelect(DB::raw("nominateds.*, users.ip AS userip, users.name AS username, REPLACE(categories.name, '|', ' ') AS cat_name"));

        $query->join('categories', 'categorie_id','categories.id');
        $query->join('users', 'user_id','users.id');

        if ($search != '') {


            $query->where(function ($query) use ($search){
                $query
                    ->orWhere('categories.name', 'like', '%'.$search.'%')
//                    ->orWhere('cat_name', 'like', '%'.$search.'%')
                    ->orWhere('nominateds.name', 'like', '%'.$search.'%')
                    ->orWhere('users.ip', 'like', '%'.$search.'%');
            });

            array_push($queryCols, 'categories.name as cat_name');
        }

        $Total = $query->count();

        /**
         * FALTA FAZER O ORDER BY POR COLUNA DE RELACIONAMENTO
         **/
        $query->orderBy($order_column['name'], $order_orient);

        $data = $query->skip($request->start)->take($length)->get($queryCols);

//dd($data);
        $arr = [
            'data' => [

            ],
            'recordsTotal' => $Total,
            "recordsFiltered" => $Total,
        ];

        /**
         * Se for array, significa que são métodos que vem do relacionamento da model
         * Necessário chamar um por um para interligar os relacionamentos e trazer o resultado final
         */
        function callRelation($model, Array $methods){
            $method = $methods[0];

            $val = call_user_func_array(
                array($model, $method),
                []
            );

            array_shift($methods);

            if (count($methods) > 0) {
                return callRelation($val, $methods);
            }else{
                return $val;
            }
        }

        foreach ($data as $user)
        {
            $u = [];
            foreach ($cols as $col)
            {
                $col_name = $col['name'];

                /*
                 * Se for array, significa que são métodos que vem do relacionamento da model
                 * Necessário chamar um por um para interligar os relacionamentos e trazer o resultado final
                */
                $val = is_array($col_name) ? callRelation($user, $col_name) : $user[$col_name];

                if ( gettype($val) == 'object' ) {
                    $action = $col['treat_method'];
                    $val = $this->$action($val);
                }

                array_push($u, $val);

            }
            array_push($arr['data'], $u);
        }

        return json_encode($arr);
    }

    public function alterStatus(Request $request)
    {
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

    public function users(Request $request, $nominated, $cat_id)
    {
        $nominated = Nominateds::where('id', $nominated)->first();

        $this->methodConfigName = 'dataTablesUsers';

        $cat = Categories::where('id', $cat_id)->first();

        $this->vars->title = $nominated->name." | ". $this->categorieName($cat->name);
//        $this->nominatedsByUser = Nominateds::where('id', $nominated->id)->where('categorie_id', $cat->id)->get();
        $this->nominatedsByUser = Nominateds::where('name', $nominated->name)->where('categorie_id', $cat->id)->get();

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

            $ref = $this->cutReference($reg->reference);

            $newInfo = [
                $reg->id,
                $this->JSONparse($reg->User->name),
                $ref->reference,
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
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => $ref->class,
                                    'href' => '#',
                                    'onload' => 'Script.tooltipReference()',
                                    'data-ref' => $reg->reference,
                                    'data-ref-col' => 2
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
            ['title' => 'User'],
            ['title' => 'Referência'],
            ['title' => 'IP'],
            ['title' => 'status'],
            ['title' => 'via'],
            ['title' => 'Ações', 'width' => '150px'],
        ];
    }

    public function rejeitados()
    {
        $this->methodConfigName = 'dataTablesRejeitados';
        $this->dataTablesInit();
        $this->vars->title = "Votos rejeitados";

        return view('dash.rejeitados', [ 'vars' => $this->vars, 'dataTables' => $this->dataTables ]);
    }

    public function dataTablesRejeitados()
    {
        $data = [];
        foreach (Nominateds::where('valid', 2)->get() as $reg)
        {
            $newInfo = [
                $reg->id,
                $this->JSONparse($reg->name),
                $this->JSONparse($reg->why_deny),
                $this->JSONparse($reg->userDeny->name),
                $this->categorieName($reg->Categorie->name),
                $this->JSONparse($reg->User->name),
                $reg->User->ip,
                [
                    'rowActions' =>
                        [
                            [
                                'html' => '',
                                'attributes' => [
                                    'class' => 'btn btn-custom btn-circle fa fa-eye m-l-10 has-tooltip',
                                    'href' => '/panel/user/'.$reg->User->id,
                                    'title' => 'Indicações do usuário'
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
            ['title' => 'Motivo'],
            ['title' => 'Quem'],
            ['title' => 'Categoria'],
            ['title' => 'User'],
            ['title' => 'IP'],
            ['title' => 'Ações', 'width' => '50px'],
        ];
    }

}
