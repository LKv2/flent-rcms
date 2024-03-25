<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Prolongation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProlongationController extends Controller
{
    public function index($id)
    {
        $booking = Booking::find($id);
        return view('booking.prolongation', compact('booking'));
    }
    public function store(Request $request)
    {
        
        $booking = Booking::findOrFail($request->id);
        $prolongation = Prolongation::create([
            'booking_id' => $booking->id,
            'old_dropoff_date' => $booking->dropoff_date,
            'new_dropoff_date' => $request->new_dropoff_date,
            'agence_id' => Auth::user()->id,
            'new_price' => $request->new_price,
        ]);
        $booking->dropoff_date = $request->new_dropoff_date;
        $subject = 'Booking Prolongation Confirmation';
        $content = "

                <p>Dear {$booking->client->fname},</p>
                <p>We are pleased to confirm the extension of your booking. Here are the details:</p>
                <ul>
                    <li><strong>Booking Reference:</strong> {$booking->id}</li>
                    <li><strong>Car:</strong> {$booking->car->marque()->name} {$booking->car->mode->name}</li>
                    <li><strong>Original Return Date and Time:</strong> {$booking->dropoff_date}</li>
                    <li><strong>New Return Date and Time:</strong> {$request->new_dropoff_date}</li>
                </ul>
                <p>Your booking has been successfully extended, and the new return date and time have been updated. If you have any questions or need further assistance, please do not hesitate to contact us. Enjoy your extended rental!</p>
                <p>Best regards,<br> Tyr Tours Team</p>

            ";

        //Mail::to($booking->client->user()->email)->send(new GenericEmail($subject, $content));
        $booking->save();
        return redirect()->route('bookings.prolongation', $request->id)
            ->with('success', 'Prolongation created successfully.');
    }
}
