<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('national_teams', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->string('code',5);
            $table->string('name', 100);
            $table->string('logo', 300);
            $table->string('city', 100)->nullable();
            $table->string('stadium', 100)->nullable();
            $table->string('stadium_address', 250)->nullable();
            $table->string('stadium_image', 300)->nullable();
            $table->bigInteger('stadium_capacity')->nullable();
            $table->smallInteger('active');
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
        Schema::dropIfExists('national_teams');
    }
}
