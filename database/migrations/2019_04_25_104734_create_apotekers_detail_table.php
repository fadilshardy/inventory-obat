<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApotekersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apotekersdetail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('id_obat');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('active');
            $table->string('id_apoteker');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apotekersdetail');
    }
}
