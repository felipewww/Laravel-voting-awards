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

    /*
     * Datatables
     * */
    public function RegisterFrom()
    {
        if ($this->fb_id != null) {
            $from = 'facebook';
        }else{
            $from = 'formulário';
        }

        return $from;
    }

    /*
     * Datatables
     * */
    public function AllActions()
    {
        $id     = $this->id;
        $fbid   = $this->fb_id;

        $userinfo = '<a class="btn btn-success btn-circle fa fa-info m-l-10 has-tooltip" href="/panel/user/'.$id.'"></a>';

        if( $fbid != null ){
            $userface = '<a class="btn btn-custom btn-circle fa fa-facebook m-l-10 has-tooltip" target="_blank" href="http://www.facebook.com/'.$fbid.'"></a>';
        }else{
            $userface = '<a class="btn btn-custom btn-circle fa fa-close m-l-10 has-tooltip" href="#"></a>';
        }

        $fullLink = $userinfo.$userface;

        return $fullLink;
    }
}
