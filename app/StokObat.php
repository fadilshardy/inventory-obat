<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokObat extends Model
{
	protected $table = 'stok';
	protected $hidden = ['created_at', 'updated_at'];
}
