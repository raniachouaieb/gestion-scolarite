<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parentes', function (Blueprint $table) {
            $table->id();
            $table->string('nomPere');
            $table->string('prenomPere');
            $table->string('telPere');
            $table->string('professionPere');
            $table->string('nomMere');
            $table->string('prenomMere');
            $table->string('telMere');
            $table->string('professionMere');
            $table->integer('nbEnfants')->default(1);
            $table->string('email');
            $table->string('password');
            $table->string('adresse');
            $table->tinyInteger('is_active')->default(0); /** 0 = en attente 1= accepter 2= refuser */
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
        Schema::dropIfExists('parentes');
    }
}
