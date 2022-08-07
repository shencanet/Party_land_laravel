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
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->string('mensajes');
            $table->unsignedBigInteger('from');
            $table->unsignedBigInteger('canal_id');
            $table->date('date');
            $table->timestamps();
            $table->foreign('from')->references('id')->on('users');
            $table->foreign('canal_id')->references('id')->on('canal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajes');
    }
};
