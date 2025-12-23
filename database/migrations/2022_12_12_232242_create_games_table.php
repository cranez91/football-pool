<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->unsignedBigInteger('round_id');
            $table->unsignedBigInteger('home_id');
            $table->unsignedBigInteger('away_id');
            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();
            $table->string('referee', 100)->nullable();
            $table->date('date')->nullable()->default(null);
            $table->time('time')->nullable()->default(null);
            $table->string('status', 5);
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
        Schema::dropIfExists('games');
    }
}
