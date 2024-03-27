<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{
    public function index()
    {
        $locations = $this->userAuth()->locations;
        $offices = $this->userAuth()->offices;

        return view('location.index', compact('locations', 'offices'));
    }
    public function store(Request $request)
    {

        if ($request->isOffice == "on") {
            $Office = Office::create([
                'agence_id' => $this->userAuth()->id,
                'city' => $request->city,
                'fixe' => $request->fixe,
                'phone' => $request->phone,
                'addressLine1' => $request->addressLine1,
                'addressLine2' => $request->addressLine2,
            ]);
            $location = Location::create([
                'name' => 'Office ' . $request->city,
                'agence_id' => $this->userAuth()->id,
                'amount' => 0,
                'office_id' => $Office->id
            ]);
        } else {
            Location::create([
                'name' => $request->name,
                'agence_id' => $this->userAuth()->id,
                'amount' => $request->amount,
            ]);
        }
        return redirect()->route('locations.index')->with('success', 'Location added successfully.');
    }
    public function update(Request $request, $id)
    {
        $location = Location::findOrFail($id);

        if ($request->isOffice == "on") {
            $location->name = 'Office ' . $request->city;
            $location->amount = 0;


            $office = $location->office;
            $office->city = $request->city;
            $office->fixe = $request->fixe;
            $office->phone = $request->phone;
            $office->addressLine1 = $request->addressLine1;
            $office->addressLine2 = $request->addressLine2;
            $office->save();
            $location->save();
        } else {
            $location->name = $request->name;
            $location->amount = $request->amount;
            $location->save();
        }

        return redirect()->route('locations.index')->with('success', 'Location updated successfully.');
    }
    public function destroy($id)
    {
        $location = Location::findOrFail($id);

        // Check if the authenticated user owns the location before deleting
        if ($location->agence_id !== $this->userAuth()->id) {
            return redirect()->route('locations.index')->with('error', 'Unauthorized to delete this location.');
        }

        // If the location is associated with an office, delete the office first
        if ($location->office()) {
            $office=$location->office();
            $location->delete();
            $office->delete();
        }else{
            $location->delete();
        }

        // Then delete the location
        

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
