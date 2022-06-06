<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->string('raison');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
            $table->integer('emploi_id')->unsigned();
            $table->foreign('emploi_id')->references('id')->on('schedules');
            $table->integer('semester');
            $table->date('date');
            $table->string('heure_deb');
            $table->string('heure_fin');
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
        Schema::dropIfExists('attendances');
    }
}
