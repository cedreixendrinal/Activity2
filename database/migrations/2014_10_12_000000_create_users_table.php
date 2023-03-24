<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('loft_name')->nullable();
            $table->string('email')->unique();
            $table->text('city')->nullable();
            $table->string('primary_number')->nullable();
            $table->text('address')->nullable();
            $table->string('e_clock_number')->nullable();
            $table->integer('club_id')->nullable();
            $table->string('password')->nullable();;
            $table->rememberToken();
            $table->integer('role')->nullable();
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
        Schema::dropIfExists('users');
    }
}
