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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id'); // ID de la réservation associée au paiement
            $table->string('methode');
            $table->string('nr')->nullable();
            $table->decimal('amount', 10, 2); // Montant du paiement, assuming it's a decimal type
            $table->timestamps();
            $table->unsignedBigInteger('agence_id')->nullable();
            $table->foreign('agence_id')->references('id')->on('users');
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
