<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Client;
use App\Models\Location;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('booking.index', compact('bookings'));
    }
    public function create()
    {
        $clients=Auth::user()->clients;
        $cars=Auth::user()->cars;
        $locations=Auth::user()->locations;
        return view('booking.create',compact('cars','clients','locations'));
    }
    public function store(Request $request)
    {
        $d1 = new DateTime(strval($request->pickup_date));
        $d2 = new DateTime(strval($request->dropoff_date));
        $interval = $d2->diff($d1);
        $numberOfDays = $interval->days;
        $booking = new Booking();
        $currentDate = new DateTime();
        $booking->car_id = $request->car;
        $booking->client_id = $request->client1_id;
        if (!$request->client2_id) {
            $booking->client2_id = $request->client2_id;
        }
        $booking->pickup_location = $request->pickup_location;
        $booking->dropoff_location = $request->dropoff_location;
        $booking->agence_id = Auth::user()->id;
        $booking->pickup_date = $request->pickup_date;
        $booking->dropoff_date = $request->dropoff_date;
        $immatriculation = $booking->car->immatriculation1 ? $booking->car->immatriculation1 . "/" . $booking->car->lettre . "/" . $booking->car->immatriculation2 : $booking->car->immatriculationWW;
        if ($d1->format('Y-m-d') === $currentDate->format('Y-m-d')) {
            $booking->km_depart = $request->km_depart;
            $booking->car->km = $request->km_depart;
            $booking->car->etat = 'Sortie';
            $booking->reservation_status = 'en cours';
           
        } else {
            $booking->km_depart = 0;
            $booking->reservation_status = 'confirmée';
        }
        $booking->km_retour = 0;
        $booking->prix_day = $booking->car->price();
        $booking->amount = $numberOfDays * $booking->car->price();
        $booking->financial_status = 'non payé';
        $booking->car->save();
        $booking->save();
        return redirect()->route('booking');
    }
}
