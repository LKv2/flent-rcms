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
    public static function totalAmountByMethod()
    {
        $payments = Agencie::where('user', Auth::user()->id)->first()->payements->groupBy('methode');
        $withdraws=Agencie::where('user', Auth::user()->id)->first()->withdraws;

        $result = [];
        $with=0.0;
        foreach ($payments as $key => $value) {
            $sum=0.0;
            foreach ($value as $item) {
                $sum+=$item->amount;
                
            }
            
            $result += [$key => $sum];
        }
        foreach ($withdraws as $value) {

            if ($value->status==='done') {
                $with+=$value->amount;
            }
        }

        $result["Paypal"] -= $with;
        // Group the payments by method and calculate the sum of amounts for each method;
        return $result;
    }
    public static function methodes()
    {
        // Group the payments by method and calculate the sum of amounts for each method
        return self::where('agence_id', Auth::user()->id)->groupBy('methode')
            ->selectRaw('methode')
            ->pluck('methode');
    }
    public static function totalAmount()
    {
        // Calculate the sum of all amounts
        return Agencie::where('user', Auth::user()->id)->first()->payements()->sum('amount');
    }
    public static function CountByMethod()
    {
        $payments = Agencie::where('user', Auth::user()->id)->first()->payements->groupBy('methode');
        $result = [];
        foreach ($payments as $key => $value) {
            $result += [$key => count($value)];
        }

        // Group the payments by method and calculate the sum of amounts for each method;
        return $result;
    }
    public static function piechart()
    {
        $total = Payment::totalAmount();
        $totalAmountByMethod = Payment::totalAmountByMethod();
        $CountByMethod = Payment::CountByMethod();
        $totalCount =count(Agencie::where('user', Auth::user()->id)->first()->payements);

        $rapport = [];
        foreach ($totalAmountByMethod as $key => $value) {
            $rapport[] = (($CountByMethod[$key] * 100 / $totalCount) + ($totalAmountByMethod[$key] * 100 / $total)) / 2;
        }

        return $rapport;
    }
}
