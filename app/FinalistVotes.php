<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalistVotes extends Model
{
    public function Finalist()
    {
        return $this->belongsTo(Finalists::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
