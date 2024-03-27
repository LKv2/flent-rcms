<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'model',
        'agence_id',
        'carburant',
        'color',
        'categorie',
        'etat',
        'nrchassis',
        'transcription',
        'immatriculation1', 'immatriculation2', 'lettre',
        'immatriculationWW',
        'km',
        'GPSCode',
        'phoneGPS',
        'puissance',
        'nbplace',
        'kmjr',
        'kmvidange',
        'price_1',
        'price_2',
        'cartegrise',
        'autorisation',
        'date_validite_autorisation',
        'control',
        'vingnette',
        'issurrance',
        'date_validite_vingnette',
        'date_validite_issurrance',
        'date_validite_control',
        'date_validite_CG',
        'status',
        'agency',
        'sous_price',
        'joint',
        'provider',
        'date_achat',
        'date_traite_achat',
        'prix_achat',
        'avance_achat',
        'duree_achat',
    ];

    // Define a relationship to the ModelBrand model (assuming it exists).
    public function mode()
    {
        return $this->belongsTo(Mode::class, 'model');
    }
    public function marque()
    {
        return Marque::find($this->mode->marque);
    }
    public function agencie()
    {
        return $this->belongsTo(Agencie::class, 'agence_id');
    }
    function traite()
    {
        $traite = $this->prix_achat - $this->avance_achat;
        return $traite / $this->duree_achat;
    }
    public function price()
    {
        // Check if the date_echange is set and not null
        if (config('app.PRICE_CHANGE')) {
            // Split date_echange into day and month components
            list($dayEchange, $monthEchange) = explode('-', config('app.PRICE_CHANGE'));
            $dayEchange = (int)$dayEchange;
            $monthEchange = (int)$monthEchange;

            // Get today's day and month
            $today = getdate();
            $currentDay = $today['mday'];
            $currentMonth = $today['mon'];

            // Compare day and month of date_echange with today
            if ($monthEchange > $currentMonth) {
                // If date_echange day and month are both greater than today, display price_2
                return $this->price_2;
            } elseif ($monthEchange == $currentMonth) {
                if ($dayEchange > -$currentDay) {
                    return $this->price_2;
                }
            }
        }

        // If no conditions are met, display price_1 (default price)
        return $this->price_1;
    }
    /*
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    public function charges()
    {
        return $this->hasMany(Charge::class,'car');
    }
*/
    public function getValibleBookings()
    {
        return $this->bookings->where('etat', '!=', 'annulée')->where('etat', '!=', 'terminée');
    }
    public function isAvailableForPeriod($startDate, $finishDate)
    {
        $bookings = $this->getValibleBookings();

        foreach ($bookings as $booking) {
            $bookingStartDate = new DateTime($booking->pickup_date);
            $bookingFinishDate = new DateTime($booking->dropoff_date);

            if (($startDate >= $bookingStartDate && $startDate <= $bookingFinishDate) ||
                ($finishDate >= $bookingStartDate && $finishDate <= $bookingFinishDate) ||
                ($startDate <= $bookingStartDate && $finishDate >= $bookingFinishDate)
            ) {
                return false; // Car is not available for this period
            }
        }

        return true; // Car is available for the requested period
    }
    public function immatriculation()
    {
        if ($this->immatriculation1) {
            return strval($this->immatriculation1)  . '|' .  $this->lettre  . '|' . strval($this->immatriculation2);
        } else {
            return $this->immatriculationWW;
        }
    }
}
