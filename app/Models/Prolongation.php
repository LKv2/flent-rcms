<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;

class Prolongation extends Model
{
    protected $fillable = [
        'booking_id',
        'old_dropoff_date',
        'new_dropoff_date',
        'new_price',
        'agence_id'
    ];

    // Define relationship with the booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    function duration(){
        $d1 = new DateTime(strval($this->old_dropoff_date));
        $d2 = new DateTime(strval($this->new_dropoff_date)); // Create a DateTime object for the current date
        $interval = $d2->diff($d1);
        return $interval->days;
    }
}
