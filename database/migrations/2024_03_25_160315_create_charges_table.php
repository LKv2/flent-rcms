<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->text('description')->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('date');
            $table->unsignedBigInteger('agence_id')->nullable();
            $table->unsignedBigInteger('car')->nullable();
            $table->timestamps();
            $table->foreign('agence_id')->references('id')->on('agencies')->onDelete('cascade');
            $table->foreign('car')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('charges');
    }
};
