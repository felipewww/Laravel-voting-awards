<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'fb_id', 'fb_link', 'ip', 'agreed', 'mail_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Nominateds()
    {
        return $this->hasMany(Nominateds::class);
    }

    public function Votes()
    {
        return $this->hasMany(FinalistVotes::class);
    }

    public function PreVotes()
    {
        return $this->hasMany(PreFinalistVotes::class);
    }
}
