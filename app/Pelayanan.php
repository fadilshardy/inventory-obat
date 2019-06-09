<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanan';
    protected $hidden = ['created_at', 'updated_at'];

    public function user_modify()
    {
        return $this->belongsTo('App\User', 'user_modified');
    }
}
