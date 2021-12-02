<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGudangObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gudang_obat', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_obat');
            $table->string('no_batch');
            $table->string('keterangan')->nullable();
            $table->string('expiry_date');
            $table->string('supplier');
            $table->integer('jumlah');
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
        Schema::dropIfExists('gudang_obat');
    }
}
