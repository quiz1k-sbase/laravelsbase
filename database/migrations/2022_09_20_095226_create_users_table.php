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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('password');
            $table->timestamps();
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('city_id');
            $table->foreign('country_id')->references('id')->on('countries')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('state_id')->references('id')->on('states')->restrictOnDelete()->cascadeOnUpdate();
            $table->foreign('city_id')->references('id')->on('cities')->restrictOnDelete()->cascadeOnUpdate();
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
};
