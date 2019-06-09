<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apotek extends Model
{
    protected $table = 'Apotek';
    public $timestamps = true;

    public function user_modify()
    {
        return $this->belongsTo('App\User', 'user_modified');
    }
}
