<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominateds extends Model
{
    //public $fillable = [];
    public function Categorie(){
        return $this->belongsTo(Categories::class);
    }
}
