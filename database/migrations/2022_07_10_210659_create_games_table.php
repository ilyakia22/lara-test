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
            $table->integer('id')->autoIncrement()->unsigned();
            $table->string('name');
            $table->integer('development_studio_id')->unsigned();
            $table->foreign('development_studio_id')->references('id')->on('development_studios');
            $table->timestamps();
            $table->index('development_studio_id');
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
