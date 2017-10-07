<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nominateds extends Model
{
    use SoftDeletes;

    //public $fillable = [];
    public function Categorie(){
        return $this->belongsTo(Categories::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function UserDeny(){
        return $this->belongsTo(User::class, 'user_id_deny');
    }

    public function AguardandoActions()
    {

        $userinfo = '<a class="btn btn-custom btn-circle fa fa-eye m-l-10 has-tooltip" href="/panel/user/'.$this->User->id.'"></a>';
        $aprovar = '<a class="btn btn-success btn-circle fa fa-check m-l-10 has-tooltip" href="#" onclick="Script._alterStatus(null, this)" data-voteid="'.$this->id.'" data-alterto="1" title="aprovar"></a>';
        $anular = '<a class="btn btn-danger btn-circle fa fa-times m-l-10 has-tooltip" href="#" onclick="Script._alterStatus(null, this)" data-voteid="'.$this->id.'" data-alterto="2" title="anular"></a>';

        $actions = $userinfo.$aprovar.$anular;

        return $actions;
    }
}
