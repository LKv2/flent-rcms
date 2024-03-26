<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Charge;
use App\Models\Client;
use App\Models\Location;
use App\Models\Task;
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
        $clients = Auth::user()->clients;
        $cars = Auth::user()->cars;
        $locations = Auth::user()->locations;
        return view('booking.create', compact('cars', 'clients', 'locations'));
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
            $taskopen = new Task();
            $taskopen->user_id = $booking->id;
            $taskopen->title = "Booking ID: {$booking->id} Checkin";
            $taskopen->description = "Car {$immatriculation} will be booked in Booking {$booking->id}";
            $taskopen->date = $booking->pickup_date;
            $taskopen->type = "Booking Task";
            $taskopen->status = 'Done';
            $this->open($booking->id,$request);
        } else {
            $booking->km_depart = 0;
            $booking->reservation_status = 'confirmée';
            $taskopen = new Task();
            $taskopen->user_id = $booking->id;
            $taskopen->title = "Booking ID: {$booking->id} Checkin";
            $taskopen->description = "Car {$immatriculation} will be booked in Booking {$booking->id}";
            $taskopen->date = $booking->pickup_date;
            $taskopen->type = "Booking Task";
            $taskopen->status = 'To-Do';
        }
        $booking->km_retour = 0;
        $booking->prix_day = $booking->car->price();
        $booking->amount = $numberOfDays * $booking->car->price();
        $booking->financial_status = 'non payé';
        $taskclose = new Task();
        $taskclose->title = "Booking ID: {$booking->id} Checkout";
        $taskclose->agence_id = Auth::user()->id;
        $taskopen->agence_id = Auth::user()->id;
        $taskclose->user_id = $booking->id;
        $taskclose->description = "Car {$immatriculation} will be available in Booking {$booking->id}";
        $taskclose->date = $booking->dropoff_date;
        $taskclose->type = "Booking Task";
        $taskclose->status = 'To-Do';
        $booking->car->save();
        $taskclose->save();
        $taskopen->save();
        $booking->save();
        return redirect()->route('booking');
    }
    public function show($id)
    {
        $booking = Booking::find($id);
        return view('booking.show', compact('booking'));
    }
    public function contract($id)
    {
        $booking = Booking::find($id);
        return view('booking.contract', compact('booking'));
    }
    public function invoice($id)
    {
        $booking = Booking::find($id);
        return view('booking.invoice', compact('booking'));
    }
    public function confirm($id)
    {
        $booking = Booking::find($id);
        $booking->reservation_status = 'confirmée';
        $subject = 'Booking Confirmation';
        $content = "
            <p>Dear {$booking->client->fname},</p>
                <p>We are pleased to confirm your car booking with us. Here are the booking details:</p>
                <ul>
                    <li><strong>Booking Reference:</strong> {$booking->id}</li>
                    <li><strong>Car:</strong> {$booking->car->marque()->name_brand} {$booking->car->modelBrand->name}</li>
                    <li><strong>Pickup Date and Time:</strong> {$booking->pickup_date}</li>
                    <li><strong>Return Date and Time:</strong> {$booking->dropoff_date}</li>
                    <li><strong>Booking Total Amount:</strong> {$booking->amount} USD</li>
                </ul>
                <p>Your reservation is confirmed, and we look forward to serving you. If you have any questions or need further assistance, please do not hesitate to contact us. Safe travels!</p>
                <p>Best regards,<br> Tyr Tours Team</p>
            ";
        //Mail::to($booking->client->user()->email)->send(new GenericEmail($subject, $content));

        $booking->save();
        return redirect()->route('booking.index');
    }
    public function cancel($id, Request $request)
    {
        $booking = Booking::find($id);
        $booking->reservation_status = 'annulée';
        $subject = 'Booking Cancellation Confirmation';
        $content = "

            <p>Dear {$booking->client->fname},</p>
            <p>We regret to inform you that your booking has been canceled. Here are the details:</p>
            <ul>
                <li><strong>Booking Reference:</strong> {$booking->id}</li>
                <li><strong>Car:</strong> {$booking->car->marque()->name} {$booking->car->mode->name}</li>
            </ul>
            <p>Your booking has been canceled, and any related charges have been processed accordingly. If you require further assistance or have questions regarding the cancellation, please contact our customer support team. We apologize for any inconvenience.</p>
            <p>Best regards,<br> Tyr Tours Team</p>

        ";
        if ($request) {
            if ($request->cout > 0) {
                $charge = new Charge();
                $charge->type = $request->type;
                $charge->description = $id;
                $charge->agence_id = Auth::user()->id;
                $charge->amount = $request->cout;
                $charge->date = $request->date;
                $charge->save();
            }
        }

        //Mail::to($booking->client->user()->email)->send(new GenericEmail($subject, $content));

        $booking->save();
        return redirect()->route('booking.index');
    }
    public function open($id, Request $request)
    {
        $booking = Booking::find($id);
        $booking->km_depart = $request->kml_depart;
        $booking->reservation_status = 'en cours';
        $booking->discount = $request->disaccount;
        $booking->carburant_depart = $request->carburant_depart;
        $booking->car->etat = 'Sortie';
        $booking->car->save();
        $booking->save();
        return redirect()->route('booking.index');
    }
    public function close($id, Request $request)
    {
        $booking = Booking::find($id);
        $booking->km_retour = $request->km_retour;
        $booking->reservation_status = 'terminée';
        $booking->surcharge = $request->surcharge;
        $booking->carburant_retour = $request->carburant_retour;
        $booking->car->etat = 'En Parc';
        $booking->car->save();
        $booking->save();
        return redirect()->route('booking.index');
    }
    public function process($id)
    {
        $booking = Booking::find($id);
        return view('payement.process', compact('booking'));
    }
}
