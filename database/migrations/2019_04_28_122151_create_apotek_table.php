<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApotekTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apotek', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_gudang');
            $table->integer('id_obat');
            $table->integer('jumlah_apotek');
            $table->integer('stok_awal');
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apotek');
    }
}
