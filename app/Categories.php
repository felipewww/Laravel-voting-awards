<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $timestamps = null;

    public function Finalists()
    {
        return $this->hasMany(Finalists::class, 'categorie_id');
    }
}
