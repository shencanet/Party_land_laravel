<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('juego_id');
            $table->timestamps();
            $table->foreign('juego_id')->references('id')->on('juegos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('canales');
    }
};
