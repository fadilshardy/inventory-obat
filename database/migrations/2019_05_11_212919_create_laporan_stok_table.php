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
            $table->integer('harga_satuan');
            $table->integer('stok_gudang');
            $table->integer('stok_loker');
            $table->integer('jumlah');
            $table->integer('harga');
            $table->integer('safety_stock');
            $table->integer('reorder_point');
            $table->string('status');

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
