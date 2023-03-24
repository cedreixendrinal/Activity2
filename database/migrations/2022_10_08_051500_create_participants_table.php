<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('race_id')->nullable();
            $table->integer('kalapati_id')->nullable();
            $table->integer('pigeon_placed')->nullable();
            $table->integer('pigeon_count')->nullable();
            $table->string('serial_code')->nullable();
            $table->string('status')->nullable();
            $table->string('speed')->nullable();
            $table->string('position')->nullable();
            $table->datetime('arrival')->nullable();
            $table->integer('flight')->nullable();
            $table->string('distance')->nullable();
            $table->integer('points')->nullable();
            $table->integer('owner_id')->nullable();
            $table->date('time_clock')->nullable();
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
        Schema::dropIfExists('participants');
    }
}
