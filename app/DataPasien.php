<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataPasien extends Model
{
    protected $table = 'data_pasien';
    public $timestamps = false;

    public function Pelayanan()
    {
        return $this->hasMany('App\Pelayanan');
    }
}
