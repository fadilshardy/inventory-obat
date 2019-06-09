<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PelayananDetail extends Model
{
    protected $table = 'pelayanan_detail';
    protected $hidden = ['created_at', 'updated_at'];

    public function pelayanan()
    {
        return $this->belongsTo('App\Pelayanan', 'id_pelayanan');
    }

    public function apotek()
    {
        return $this->belongsTo('App\apotek', 'id_obat');
    }
}
