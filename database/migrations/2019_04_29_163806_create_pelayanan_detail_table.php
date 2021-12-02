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
            $table->integer('id_obat');
            $table->integer('id_apotek');
            $table->integer('id_pelayanan');
            $table->string('qty');
            $table->string('harga_jual');
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
        Schema::dropIfExists('pelayanan_detail');
    }
}
