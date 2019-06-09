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
            $table->string('no_batch');
            $table->string('keterangan');
            $table->string('dosis');
            $table->string('expiry_date');
            $table->string('kategori_obat');
            $table->string('bentuk_sediaan');
            $table->string('supplier');
            $table->integer('harga_satuan');
            $table->integer('jumlah');
            $table->boolean('instock');
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