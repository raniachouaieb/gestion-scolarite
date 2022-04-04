<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id')->unsigned();
            $table->foreign('class_id')->references('id')->on('classerooms');
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
        Schema::dropIfExists('infos_classes');
    }
}
