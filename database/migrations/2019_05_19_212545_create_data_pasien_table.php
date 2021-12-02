<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_pasien', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pasien');
            $table->string('gender');
            $table->string('tanggal_lahir');
            $table->string('alamat');
            $table->bigInteger('no_telp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_pasien');
    }
}
