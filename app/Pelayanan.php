<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanan';
    protected $hidden = ['created_at', 'updated_at'];

    public function DataPasien()
    {
        return $this->belongsTo('App\DataPasien', 'id_pasien');
    }
}
