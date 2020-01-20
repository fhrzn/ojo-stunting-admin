<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataRespondensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_respondens', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nama_responden');
            $table->text('alamat_responden');
            $table->integer('hasil_kuesioner');
            $table->integer('surveyor')->unsigned();
            $table->integer('jenis_kuesioner');
            $table->timestamps();

            $table->foreign('surveyor')
                  ->references('id')->on('kaders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_respondens');
    }
}
