<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficesTable extends Migration
{
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->string('fixe')->nullable();
            $table->string('phone')->nullable();
            $table->string('addressLine1')->nullable();
            $table->string('addressLine2')->nullable();
            $table->unsignedBigInteger('agence_id')->nullable();
            $table->unsignedBigInteger('user')->unique()->nullable();
            $table->timestamps();
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('agence_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('offices');
    }
}