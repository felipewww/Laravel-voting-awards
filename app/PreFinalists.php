<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreFinalists extends Model
{
    public function Categorie()
    {
        return $this->belongsTo(Categories::class);
    }

    public function Votes()
    {
        return $this->hasMany(PreFinalistVotes::class, 'pre_finalist_id');
    }
}
