<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GudangObat extends Model
{
  protected $table = 'gudang_obat';
  public $timestamps = true;


  public function MasterObat()
  {
    return $this->belongsTo('App\MasterObat', 'id_obat');
  }

 
 
}
