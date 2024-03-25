<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'client_id',       // ID of the first client
        'client2_id',
        'agence_id',
        'car_id',
        'pickup_location',
        'dropoff_location',
        'pickup_date',
        'dropoff_date',
        'km_depart',
        'carburant_depart',
        'km_retour',
        'carburant_retour',
        'financial_status', // État financier de la réservation (payé, en attente, etc.)
        'reservation_status', // État de la réservation (confirmée, en cours, terminée, annulée, etc.)
        'amount', // Montant total de la réservation
        'discount', // Remise (le cas échéant)
        'surcharge', // Surcharges (le cas échéant)
        'prix_day'
    ];

    // Define relationships
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function agencie()
    {
        return $this->belongsTo(Agencie::class, 'agence_id');
    }
    public function pickLo()
    {
        return $this->belongsTo(Location::class, 'pickup_location');
    }
    public function dropLo()
    {
        return $this->belongsTo(Location::class, 'dropoff_location');
    }
    public function client2()
    {
        return $this->belongsTo(Client::class, 'client2_id');
    }
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function prolongations()
    {
        return $this->hasMany(Prolongation::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    function duration()
    {
        $d1 = new DateTime(strval($this->pickup_date));
        $d2 = new DateTime(strval($this->dropoff_date)); // Create a DateTime object for the current date
        $interval = $d2->diff($d1);
        return $interval->days;
    }
    function reste()
    {
        $total = $this->amount;
        $total += $this->pickLo->amount;
        $total += $this->dropLo->amount;
        foreach ($this->payments as $payment) {
            $total -= $payment->amount;
        }
        foreach ($this->prolongations as $prolongation) {
            $total += $prolongation->duration() * $prolongation->new_price;
        }
        return $total;
    }
    function amount()
    {
        $total = $this->amount;
        $total += $this->pickLo->amount;
        $total += $this->dropLo->amount;
        foreach ($this->prolongations as $prolongation) {
            $total += $prolongation->duration() * $prolongation->new_price;
        }
        return $total;
    }
    
    public function prolongationDays()
    {
        // Get the current booking's drop-off date
        $currentBookingDropOff = $this->dropoff_date;
        // Check if the car is reserved by another customer the day after drop-off
        $nextDay = date('Y-m-d', strtotime($currentBookingDropOff . ' + 1 day'));
        $nextBooking = Booking::where('car_id', $this->car_id)
            ->where('pickup_date',  $nextDay)->where('reservation_status', 'confirmée')->first();
        if (!$nextBooking) {
            $nextBooking = Booking::where('car_id', $this->car_id)
                ->where('pickup_date', '>', $this->dropoff_date)->where('reservation_status',  'confirmée')
                ->first();
            if ($nextBooking) {
                $currentBookingPickup = new DateTime($this->dropoff_date);
                $nextBookingPickup = new DateTime($nextBooking->pickup_date);
                return $nextBookingPickup->diff($currentBookingPickup)->days === 1 ? -1 : $nextBookingPickup->diff($currentBookingPickup)->days - 1;
            }
            // Case 1: Car is not reserved by another customer (Always possible to prolong)
            return 0;
        }


        return -1; // Default: Not possible to prolong
    }
}
