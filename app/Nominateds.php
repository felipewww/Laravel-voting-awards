<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominateds extends Model
{
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
