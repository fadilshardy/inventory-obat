<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GudangObat extends Model
{
    protected $table = 'gudang_obat';
    public $timestamps = true;

    public function kategoriobat()
		{
			return $this->belongsTo('App\KategoriObat');
		}

    public function supplier()
    {
      return $this->hasMany('App\Supplier');
    }

    public function bentuksediaan()
    {
      return $this->hasMany('App\BentukSediaan');
    }
}
