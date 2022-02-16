<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePareentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pareents', function (Blueprint $table) {
            $table->id();
            $table->string('nomPere');
            $table->string('prenomPere');
            $table->string('telPere');
            $table->string('professionPere');
            $table->string('nomMere');
            $table->string('prenomMere');
            $table->string('telMere');
            $table->string('professionMere');
            $table->integer('nbEnfants');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->binary('is_active'); /** '0' == en attent '1' ==accepter '2' == 'refuser' */
            $table->rememberToken();
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
        Schema::dropIfExists('pareents');
    }
}
