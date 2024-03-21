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
        Schema::create('modes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marque');
            $table->string('name')->unique();
            $table->integer('year');
            $table->string('front_image')->nullable();
            $table->string('back_image')->nullable();
            $table->string('interior_image')->nullable();
            $table->string('exterior_image')->nullable();
            $table->foreign('marque')->references('id')->on('marques')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modes');
    }
};
