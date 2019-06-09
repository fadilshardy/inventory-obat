<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePelayananDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelayanan_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('id_obat');
            $table->string('jumlah');
            $table->string('harga');
            $table->string('id_pelayanan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelayanan_detail');
    }
}
