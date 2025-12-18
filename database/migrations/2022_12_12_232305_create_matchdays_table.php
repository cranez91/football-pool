<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchdaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matchdays', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 300);
            $table->string('name', 150);
            $table->smallInteger('current');
            $table->unsignedBigInteger('league_id');
            $table->smallInteger('number_matches')->nullable();
            $table->smallInteger('active')->default(0);
            $table->smallInteger('visible')->default(1);
            $table->integer('price')->nullable();
            $table->integer('high_prize')->nullable();
            $table->integer('low_prize')->nullable();
            $table->dateTime('start_date', $precision = 0)->nullable();
            $table->dateTime('end_date', $precision = 0)->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matchdays');
    }
}
