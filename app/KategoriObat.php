<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriObat extends Model
{
	protected $table = 'kategori_obat';
	protected $hidden = ['created_at', 'updated_at'];
}
