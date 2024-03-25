<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Charge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChargeController extends Controller
{
    public function index()
    {
        $charges = Auth::user()->charges;
        $cars = Auth::user()->cars;

        return view('charge.index', compact('charges', 'cars'));
    }
    public function store(Request $request)
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
        $charge->agence_id = Auth::user()->id;
        $charge->amount = $request->cout;
        $charge->date = $request->date;

        // Save the charge
        $charge->save();
        if ($request->type !== 'Reparation' && $request->type !== 'Office') {
            // Update the Car model based on the charge type
            $this->update($request, $charge);
        }


        // Redirect or return a response as needed
        return redirect()->route('charge')->with('success', 'Charge added successfully.');
    }

    public function update(Request $request, Charge $charge)
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
