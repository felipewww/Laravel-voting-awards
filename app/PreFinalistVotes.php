<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreFinalistVotes extends Model
{
    public function Finalist()
    {
        return $this->belongsTo(PreFinalists::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
