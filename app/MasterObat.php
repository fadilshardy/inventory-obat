<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterObat extends Model
{
    protected $table = 'master_obat';
    public $timestamps = true;

    public function kategoriobat()
    {
        return $this->belongsTo('App\KategoriObat');
    }

    public function bentuksediaan()
    {
        return $this->hasMany('App\BentukSediaan');
    }
}
