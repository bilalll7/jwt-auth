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
        Schema::create('votes', function (Blueprint $table) {
            $table->unsignedBigInteger('choice_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('poll_id');
            $table->timestamps();
            $table->unsignedBigInteger('division_id');

            $table->foreign('choice_id')->references('id')->on('choices')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('poll_id')->references('id')->on('polls')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('divisions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('votes');
    }
};
