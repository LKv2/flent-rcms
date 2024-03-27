<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    protected $table = 'payments'; // Nom de la table dans la base de données

    protected $fillable = [
        'booking_id', // ID de la réservation associée au paiement
        'methode',
        'amount', // Montant du paiement
        'agence_id'
    ];

    // Relation avec le modèle Reservation (un paiement appartient à une réservation)
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function agencie()
    {
        return $this->belongsTo(Agencie::class, 'agence_id');
    }
}
