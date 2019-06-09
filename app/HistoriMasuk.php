<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriMasuk extends Model
{
    protected $table = 'histori_masuk';
    public $timestamps = true;

    public function user_modify()
    {
        return $this->belongsTo('App\User', 'user_modified');
    }
}
