<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMatchdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_matchdays', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('matchday_id');
            $table->unsignedBigInteger('distribuitor_id')->nullable();
            $table->smallInteger('paid');
            $table->smallInteger('winner');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('matchday_id')->references('id')->on('matchdays');
            $table->foreign('distribuitor_id')->references('id')->on('distribuitors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_matchdays');
    }
}
