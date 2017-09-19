<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    public $table = 'application';

    public static function Info()
    {
        return self::first();
    }
}
