<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_obat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_obat');
            $table->string('bentuk_sediaan');
            $table->string('dosis');
            $table->integer('harga_satuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_obat');
    }
}
