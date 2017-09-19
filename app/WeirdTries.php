<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WeirdTries extends Model
{
    public $fillable = ['info_json'];

    public static function makeAndSave($data)
    {
        $model = new WeirdTries();
        $model->info_json = json_encode($data);
        $model->save();
    }
}
