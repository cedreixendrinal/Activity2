<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();
            $table->dateTime('date_start')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->text('address')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('participant_id')->nullable();

            $table->integer('club_id')->nullable();
            $table->string('description')->nullable();
            $table->string('min_speed')->nullable();
            $table->string('additional_points')->nullable();

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
        Schema::dropIfExists('races');
    }
}
