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
        Schema::create('bookings', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('client2_id')->nullable();
            $table->unsignedBigInteger('car_id');
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->dateTime('pickup_date');
            $table->dateTime('dropoff_date');
            $table->integer('km_depart')->nullable();
            $table->integer('km_retour')->nullable();
            $table->string('carburant_depart')->nullable();
            $table->string('carburant_retour')->nullable();
            $table->string('financial_status')->nullable();
            $table->string('reservation_status');
            $table->decimal('amount', 10, 2);
            $table->decimal('discount', 10, 2)->nullable();
            $table->decimal('surcharge', 10, 2)->nullable();
            $table->decimal('prix_day', 10, 2);
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('client2_id')->references('id')->on('clients');
            $table->unsignedBigInteger('agence_id')->nullable();
            $table->foreign('agence_id')->references('id')->on('users');
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
