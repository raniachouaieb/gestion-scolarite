<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nomEleve');
            $table->string('prenomEleve');
            $table->string('classe');
            $table->string('niveau');
           $table->tinyInteger('gender')->default(0); /** '0' == garcon '1' == fille */
           $table->integer('parent_id')->unsigned(); 
           $table->foreign('parent_id')->references('id')->on('pareents'); 
           $table->integer('class_id')->unsigned(); 
           $table->foreign('class_id')->references('id')->on('classerooms'); 
           $table->softDeletes(); 
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
        Schema::dropIfExists('students');
    }
}
