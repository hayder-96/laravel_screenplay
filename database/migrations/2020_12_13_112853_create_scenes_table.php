<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scenes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('numScene');
            $table->string('nameScene');
            $table->longText('contentScene');
            $table->longText('dialogueScene');
            $table->integer('user_id');
            $table->unsignedBigInteger('main_screen_id');
            $table->timestamps();
            $table->foreign('main_screen_id')->references('id')->on('main_screens')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scenes');
    }
}
