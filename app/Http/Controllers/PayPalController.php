<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use App\Mail\GenericEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {

        $booking = Booking::find($request->id);
        $price = round($booking->reste() / 10.5, 2);
        if (!$booking) {
            return redirect()->route('booings.confirmation')->withErrors('error', 'Booking not found.');
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('Transaction.success', ['id' => $booking->id]),
                "cancel_url" => route('Transaction.cancel', ['id' => $booking->id]),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $price
                    ]
                ]
            ]
        ]);
        if (isset($response['id']) && $response['id'] != null) {
            // Redirect to PayPal for approval
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()->route('booings.confirmation', ['id' => $booking->id])->withErrors('error', 'Something went wrong.');
        } else {
            return redirect()->route('booings.confirmation', ['id' => $booking->id])->withErrors('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $booking = Booking::find($request->id);
            $booking->reservation_status = 'confirmée';
            $booking->financial_status = 'payé';
            $payment = new Payment();
            $payment->booking_id = $request->id;
            $payment->methode = 'Paypal';
            $payment->agence_id = $booking->agence_id;
            $payment->amount = $booking->reste();
            $subject = 'Payment Receipt';
            $content = "

            <p>Dear {$booking->client->fname},</p>
            <p>We are writing to confirm the successful receipt of your payment. Your commitment to prompt payment is greatly appreciated, and it allows us to continue providing you with our services.</p>
            <p>Below are the details of your recent payment:</p>
            <ul>
                <li><strong>Payment Date:</strong> {$payment->created_at}</li>
                <li><strong>Payment Amount:</strong> {$payment->amount}.00 USD </li>
                <li><strong>Payment Method:</strong> Espece</li>
                <li><strong>Invoice Number:</strong> {$payment->id}</li>
            </ul>
            <p>If you have any questions or concerns regarding this payment or your account, please don't hesitate to contact our support team. We're here to assist you in any way we can.</p>
            <p>Thank you for your continued trust and partnership with {_APP-Name}.</p>
            <p>Best regards,<br> Tyr Tours Team</p>
        ";

            //Mail::to($booking->client->user()->email)->send(new GenericEmail($subject, $content));
            $payment->save();
            $booking->save();

            return view('payement.success', compact('booking'))->with('success', 'Transaction complete.');
        } else {
            return redirect()->route('booings.confirmation', ['id' => $request->id])->withErrors('error', $response['message'] ?? 'Something went wrong.');
        }
    }
    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request)
    {
        return redirect()->route('booings.confirmation', ['id' => $request->id])->withErrors('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
