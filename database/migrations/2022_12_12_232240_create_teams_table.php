<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('code',5)->nullable();
            $table->string('name', 100);
            $table->string('nickname', 100);
            $table->string('logo', 300);
            $table->string('city', 100);
            $table->string('stadium', 100);
            $table->string('stadium_address', 250);
            $table->string('stadium_image', 300);
            $table->bigInteger('stadium_capacity');
            $table->smallInteger('active');
            $table->unsignedBigInteger('league_id');
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
        Schema::dropIfExists('teams');
    }
}
