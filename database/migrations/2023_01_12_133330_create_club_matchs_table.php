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
        Schema::create('club_matchs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matchs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('club_id')->constrained('clubs')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('gol');
            $table->enum('result',['win','lose','draw'])->nullable();
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
        Schema::dropIfExists('club_matchs');
    }
};
