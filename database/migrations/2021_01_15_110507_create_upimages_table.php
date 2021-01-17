<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpimagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upimages', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->unsignedBigInteger('film_id')->unique();
            $table->string('title');
            $table->foreign('film_id')->references('id')->on('main_screens')->onDelete('cascade');
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
        Schema::dropIfExists('upimages');
    }
}
