<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index($id)
    {
        $booking = Booking::find($id);
        if ($booking->reste() === 0.0) {
            $booking->financial_status = 'payé';
        } else {
            $booking->financial_status = 'non payé';
        }
        $booking->save();

        return view('booking.payement', compact('booking'));
    }
    public function store(Request $request)
    {
        $bookingId = $request->id;
        $booking = Booking::find($bookingId);
        if ($request->price === $booking->reste()) {
            $booking->financial_status = 'payé';
            $booking->save();
        }
        $payment = new Payment();
        $payment->booking_id = $bookingId;
        $payment->methode = $request->methode;
        $payment->agence_id = Auth::user()->id;

        $payment->amount = $request->price;
        $subject = 'Payment Receipt';
        $content = "

            <p>Dear {$booking->client->fname},</p>
            <p>We are writing to confirm the successful receipt of your payment. Your commitment to prompt payment is greatly appreciated, and it allows us to continue providing you with our services.</p>
            <p>Below are the details of your recent payment:</p>
            <ul>
                <li><strong>Payment Date:</strong> {$payment->created_at}</li>
                <li><strong>Payment Amount:</strong> {$payment->amount}.00 </li>
                <li><strong>Payment Method:</strong> Espece</li>
                <li><strong>Invoice Number:</strong> {$payment->id}</li>
            </ul>
            <p>If you have any questions or concerns regarding this payment or your account, please don't hesitate to contact our support team. We're here to assist you in any way we can.</p>
            <p>Thank you for your continued trust and partnership with {_APP-Name}.</p>
            <p>Best regards,<br> Tyr Tours Team</p>
        ";

        //Mail::to($booking->client->user()->email)->send(new GenericEmail($subject, $content));
        $payment->save();
        return redirect()->route('bookings.payement', $request->id)->with('success', 'Payment recorded successfully.');
    }
}
