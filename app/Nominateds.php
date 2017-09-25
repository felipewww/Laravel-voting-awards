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
}
