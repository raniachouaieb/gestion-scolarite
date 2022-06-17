<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBulletinsFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bulletins_files', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('file_type');
            $table->string('file_extension');
            $table->integer('create_user');
            $table->integer('update_user');
            $table->unsignedBigInteger('bulletin_id');
            $table->foreign('bulletin_id')->references('id')->on('bulletins')
                ->onDelete('cascade');
            $table->integer('file_width')->nullable();
            $table->integer('file_height')->nullable();
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
        Schema::dropIfExists('bulletins_files');
    }
}
