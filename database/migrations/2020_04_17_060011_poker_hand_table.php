<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PokerHandTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poeker_hand', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('match_id');
//            $table->foreign('match_id')->references('id')->on('poker_match');
            $table->tinyInteger('belongs_to_user')->index()->default(0);
            $table->string('cards', 20);
            $table->dateTime('created_at')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poker_hand');
    }
}
