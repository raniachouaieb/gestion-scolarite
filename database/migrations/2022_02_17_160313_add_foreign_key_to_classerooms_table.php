<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToClasseroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classerooms', function (Blueprint $table) {
            $table->integer('id_level')->unsigned(); 
            $table->foreign('id_level')->references('id')->on('levels'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('classerooms', function (Blueprint $table) {
            //
        });
    }
}
