<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_genre', function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->unsigned();

            $table->integer('game_id')->unsigned();
            $table->foreign('game_id')
                ->references('id')
                ->on('games')->onDelete('cascade');

            $table->integer('genre_id')->unsigned();
            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')->onDelete('cascade');

            //$table->unique(['genre_id', 'game_id'], 'genre_game_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_genres');
    }
}
