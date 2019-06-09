<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApotekersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apotekers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('tanggal');
            $table->string('no_nota');
            $table->string('total');
            $table->string('active');
            $table->string('user_modified');
            $table->string('keterangan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apotekers');
    }
}
