<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apotek extends Model
{
    protected $table = 'Apotek';
    public $timestamps = true;

    public function MasterObat()
    {
        return $this->belongsTo('App\MasterObat', 'id_obat');
    }

    public function GudangObat()
    {
        return $this->belongsTo('App\GudangObat', 'id_gudang');
    }
}
