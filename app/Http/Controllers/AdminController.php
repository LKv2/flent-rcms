<?php

namespace App\Http\Controllers;

use App\Charts\payementMethod;
use App\Models\Client;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Charts\PaymentMethodChart;
use App\Models\Agencie;
use App\Models\Car;
use App\Models\Charge;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class AdminController extends Controller
{
    public function index()
    {
        $chiffreAffaire=Agencie::where('user', Auth::user()->id)->first()->Totalbookings();
        $Charge=Agencie::where('user', Auth::user()->id)->first()->Totalcharges();
        $Profite=Agencie::where('user', Auth::user()->id)->first()->TotalProfite();
        $payements=Agencie::where('user', Auth::user()->id)->first()->Totalpayements();
        $unpayed=Agencie::where('user', Auth::user()->id)->first()->Totalunpayed();
        
        $nbClient = Count(Agencie::where('user', Auth::user()->id)->first()->clients);
        $nbCarsParc=Count(Car::where('etat','en parc')->where('agence_id',Agencie::where('user', Auth::user()->id)->first()->id)->get());
        $nbCarsOut=Count(Car::where('etat','sortie')->where('agence_id',Agencie::where('user', Auth::user()->id)->first()->id)->get());
        $nbCarsReparation=Count(Car::where('etat','panne')->where('agence_id',Agencie::where('user', Auth::user()->id)->first()->id)->get());
        $bookings=Agencie::where('user', Auth::user()->id)->first()->bookings;
        $nbTasks=Count(Agencie::where('user', Auth::user()->id)->first()->tasks);
        
        $nbBookings = Count($bookings);
        $nbCars = Count(Agencie::where('user', Auth::user()->id)->first()->cars);

        // Add any logic to retrieve data for the admin dashboard
        return view('admin.dashboard',compact('nbClient','chiffreAffaire','nbBookings','nbCars','nbTasks','nbCarsParc','nbCarsOut','nbCarsReparation','Charge','Profite','payements','unpayed'));
    }
    public function indexCleint()
    {
        $clients = Agencie::where('user', Auth::user()->id)->first()->clients;


        // Add any logic to retrieve data for the admin dashboard
        return view('admin.clients.index', compact('clients'));
    }
    public function indexCharge()
    {
        $charges = Agencie::where('user', Auth::user()->id)->first()->charges;
        $cars = Agencie::where('user', Auth::user()->id)->first()->cars;

        return view('admin.charges.index', compact('charges', 'cars'));
    }
    public function indexGps()
    {


        // Add any logic to retrieve data for the admin dashboard
        return view('admin.gps.index');
    }
    public function indexPayement()
    {
        $payements = Agencie::where('user', Auth::user()->id)->first()->payements;
        $online = Agencie::where('user', Auth::user()->id)->first()->online;
        $withdraws=Agencie::where('user', Auth::user()->id)->first()->withdraws;
        $totalAmount = Payment::totalAmount();
        $totalAmountByMethod = Payment::totalAmountByMethod();
        return view('admin.payement.index', compact('payements', 'totalAmountByMethod', 'totalAmount', 'online','withdraws'));
    }
    public function indexWeb()
    {
        $locations = Location::all();
        // Add any logic to retrieve data for the admin dashboard
        return view('admin.web', compact('locations'));
    }
    public function updateOnlineStatus(Request $request)
    {

        // Retrieve the boolean value from the request
        $status = $request->status === "on";
        $agence = Agencie::where('user', Auth::user()->id)->first();
        $agence->online = $status;
        $agence->save();
        return redirect()->route('payment')->with('success', 'Payment recorded successfully.');
    }
    public function storeCharge(Request $request)
    {
        $charge = new Charge();
        $charge->type = $request->type;
        // Validate the request as needed
        switch ($request->type) {
            case 'Reparation':
            case 'Office':
                $charge->description = $request->description; // Add other fields as needed
                break;

            default:
                $charge->car = $request->car;
                break;
        }
        // Create a new Charge instance
        $charge->agence_id = Agencie::where('user', Auth::user()->id)->first()->id;
        $charge->amount = $request->cout;
        $charge->date = $request->date;

        // Save the charge
        $charge->save();
        if ($request->type !== 'Reparation' && $request->type !== 'Office') {
            // Update the Car model based on the charge type
            $this->updateCarCharge($request, $charge);
        }


        // Redirect or return a response as needed
        return redirect()->route('charge')->with('success', 'Charge added successfully.');
    }

    public function updateCarCharge(Request $request, Charge $charge)
    {
        $carId = $request->car;

        // Fetch the car instance
        $car = Car::findOrFail($carId);

        // Update car attributes based on charge type
        switch ($charge->type) {

            case 'Vidange':
                // Update the 'kmvidange' attribute in the Car model
                $car->kmvidange = $request->kmvidange;
                break;
            case 'Autorisation Circulation':
                // Update other attributes for 'Autorisation Circulation'
                $car->date_validite_autorisation = $request->date_validite_autorisation;
                // Handle file upload for 'autorisation' field
                if ($request->hasFile('autorisation')) {
                    $this->uploadFileCharge($request->file('autorisation'), $car, 'autorisation');
                }
                break;
            case 'Control Technique':
                // Update other attributes for 'Control Technique'
                $car->date_validite_control = $request->date_validite_control;
                // Handle file upload for 'control' field
                if ($request->hasFile('control')) {
                    $this->uploadFileCharge($request->file('control'), $car, 'control');
                }
                break;
            case 'Carte Grise':
                // Update other attributes for 'Carte Grise'
                $car->date_validite_CG = $request->date_validite_CG;
                // Handle file upload for 'verso' field
                if ($request->hasFile('cartegrise')) {
                    $this->uploadFileCharge($request->file('cartegrise'), $car, 'cartegrise');
                }
                break;
            case 'Vignette Renewal':
                // Update other attributes for 'Vignette Renewal'
                $car->date_validite_vingnette = $request->date_validite_vingnette;
                // Handle file upload for 'vignette' field
                if ($request->hasFile('vignette')) {
                    $this->uploadFileCharge($request->file('vignette'), $car, 'vignette');
                }
                break;
            case 'Insurance Renewal':
                // Update other attributes for 'Insurance Renewal'
                $car->date_validite_issurrance = $request->date_validite_issurrance;
                // Handle file upload for 'issurance' field
                if ($request->hasFile('issurance')) {
                    $this->uploadFileCharge($request->file('issurance'), $car, 'issurance');
                }
                break;
        }

        // Save the changes to the Car model
        $car->save();
    }

    public function uploadFileCharge($file, Car $car, $field)
    {
        // Example: store the file in the 'uploads' disk
        $path = $file->store('cars/' . $field, 'public');

        // Update the car model with the file path
        $car->$field = $path;
    }
}
