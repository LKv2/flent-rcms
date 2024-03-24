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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('phone');
            $table->string('adresse');
            $table->string('date_naissance')->nullable();
            $table->string('nationalite')->nullable();
            $table->string('ville')->nullable();
            $table->string('cin')->unique();
            $table->string('permis')->unique();
            $table->string('passport')->unique()->nullable();
            $table->string('file_input_C')->nullable();
            $table->string('file_input_P')->nullable();
            $table->date('CDelivre_date')->nullable();
            $table->date('CValide_date')->nullable();
            $table->date('PDelivre_date')->nullable();
            $table->date('PValide_date')->nullable();
            $table->date('PassDelivre_date')->nullable();
            $table->date('PassValide_date')->nullable();
            $table->unsignedBigInteger('user')->unique()->nullable();
            $table->foreign('user')->references('id')->on('users');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
