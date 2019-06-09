<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApotekerDetail extends Model
{
    protected $table = 'apotekersdetail';
    protected $hidden = ['created_at', 'updated_at'];

    public function apoteker()
    {
        return $this->belongsTo('App\apoteker', 'id_apoteker');
    }

    public function gudangObat()
    {
        return $this->belongsTo('App\GudangObat', 'id_obat');
    }
}
