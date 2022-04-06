<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClasseroomInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classeroom_info', function (Blueprint $table) {
            $table->id();
            $table->integer('classeroom_id')->unsigned();
            $table->foreign('classeroom_id')->references('id')->on('classerooms');
            $table->integer('info_id')->unsigned();
            $table->foreign('info_id')->references('id')->on('infos');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classeroom_info');
    }
}
