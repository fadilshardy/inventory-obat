<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoriGudang extends Model
{
    protected $table = 'histori_gudang';
    public $timestamps = true;

    public function user_modify()
    {
        return $this->belongsTo('App\User', 'user_modified');
    }

    public function gudang_obat()
    {
        return $this->belongsTo('App\GudangObat', 'id_gudang');
    }
}
