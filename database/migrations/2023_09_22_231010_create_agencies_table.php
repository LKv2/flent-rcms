<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->string('fname');
            $table->string('lname');
            $table->string('phone');
            $table->integer('groupId');
            $table->string('adresse');
            $table->boolean('online')->default(true);
            $table->string('date_naissance')->nullable();
            $table->string('file_input_C')->nullable();
            $table->string('cin')->unique();
            $table->unsignedBigInteger('user')->unique()->nullable();
            $table->timestamps();
            $table->foreign('user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
