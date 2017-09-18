<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finalists extends Model
{
    public function Categorie()
    {
        return $this->belongsTo(Categories::class);
    }

    public function Votes()
    {
        return $this->hasMany(FinalistVotes::class, 'finalist_id');
    }
}
