<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Winners extends Model
{
    public $timestamps = false;

    public function Categorie(){
        return $this->belongsTo(Categories::class);
    }
}
