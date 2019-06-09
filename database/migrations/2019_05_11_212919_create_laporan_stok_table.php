<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporanStokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_stok', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_obat');
            $table->string('dosis');
            $table->string('bentuk_sediaan');
            $table->integer('stok_gudang')->nullable();
            $table->integer('stok_apotek')->nullable();
            $table->integer('stok_masuk_gudang')->nullable();
            $table->integer('stok_masuk_apotek')->nullable();
            $table->integer('stok_keluar_gudang')->nullable();
            $table->integer('stok_keluar_apotek')->nullable();
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
        Schema::dropIfExists('laporan_stok');
    }
}
