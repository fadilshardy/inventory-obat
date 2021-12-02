<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MasterObat extends Model
{
    protected $table = 'master_obat';
    public $timestamps = false;


    public function GudangObat()
    {
      return $this->hasMany('App\GudangObat', 'id', 'id_obat');
    }
  
    public function Apotek()
    {
        return $this->hasMany('App\Apotek');
    }
}
