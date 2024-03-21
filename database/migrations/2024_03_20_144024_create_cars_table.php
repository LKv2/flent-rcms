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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model');
            $table->unsignedBigInteger('categorie');
            $table->string('color');
            $table->string('carburant');
            $table->string('etat');
            $table->string('nrchassis')->unique();
            $table->string('GPSCode')->unique()->nullable();
            $table->string('phoneGPS')->unique()->nullable();
            $table->string('transcription');
            $table->string('immatriculation1')->nullable();
            $table->string('immatriculation2')->nullable();
            $table->string('lettre')->nullable();
            $table->string('immatriculationWW')->nullable();
            $table->integer('km');
            $table->integer('puissance');
            $table->integer('nbplace');
            $table->integer('kmjr');
            $table->integer('kmvidange');
            $table->float('price_1');
            $table->float('price_2');
            $table->string('cartegrise')->nullable();
            $table->string('autorisation')->nullable();
            $table->date('date_validite_autorisation');
            $table->string('control')->nullable();
            $table->string('vignette')->nullable();
            $table->string('issurrance')->nullable();
            $table->date('date_validite_vignette')->nullable();
            $table->date('date_validite_issurrance')->nullable();
            $table->date('date_validite_control');  
            $table->date('date_validite_CG');
            $table->string('status')->nullable();
            $table->string('agency')->nullable();
            $table->float('sous_price')->nullable();
            $table->string('joint')->nullable();
            $table->string('provider')->nullable();
            $table->date('date_achat')->nullable();
            $table->date('date_traite_achat')->nullable();
            $table->float('prix_achat')->nullable();
            $table->float('avance_achat')->nullable();
            $table->integer('duree_achat')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('agence_id')->nullable();
            $table->foreign('agence_id')->references('id')->on('users');
            $table->foreign('model')->references('id')->on('modes')->onDelete('cascade');
            $table->foreign('categorie')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
