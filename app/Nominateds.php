<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nominateds extends Model
{
    public function Categorie(){
        return $this->belongsTo(Categories::class);
    }
}
