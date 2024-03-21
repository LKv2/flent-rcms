<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Categorie;
use App\Models\Marque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function index()
    {
        $content=[
            'etat' => ['name' => 'ETAT', 'list' => ['car' => [['name' => 'Parc', 'value' => 'En Parc'], ['name' => 'Out', 'value' => 'Sortie'], ['name' => 'Breakdown', 'value' => 'En Panne']]]],
            'status' => ['name' => 'Status', 'list' => ['car' => [['name' => 'Sous Location', 'value' => 'Sous Location'], ['name' => 'Credit', 'value' => 'credit'], ['name' => 'Completed', 'value' => 'Completed']]]],
            'carburant' => ['name' => 'Carburant', 'list' => [['name' => 'Gasoline', 'value' => 'Gasoline'], ['name' => 'Diesel', 'value' => 'Diesel'], ['name' => 'Electricity', 'value' => 'Electricity']]],
            'transcription' => ['name' => 'Transcription', 'list' => [['name' => 'Automatic', 'value' => 'automatique'], ['name' => 'Manuel', 'value' => 'manuel']]],
        ];
        $cars = Car::all();
        $marques=Marque::all();
        $categories=Categorie::all();
        return view('car.index', compact('cars','marques','categories','content'));
    }

    public function create()
    {
        $content=[
            'etat' => ['name' => 'ETAT', 'list' => ['car' => [['name' => 'Parc', 'value' => 'En Parc'], ['name' => 'Out', 'value' => 'Sortie'], ['name' => 'Breakdown', 'value' => 'En Panne']]]],
            'status' => ['name' => 'Status', 'list' => ['car' => [['name' => 'Sous Location', 'value' => 'Sous Location'], ['name' => 'Credit', 'value' => 'credit'], ['name' => 'Completed', 'value' => 'Completed']]]],
            'carburant' => ['name' => 'Carburant', 'list' => [['name' => 'Gasoline', 'value' => 'Gasoline'], ['name' => 'Diesel', 'value' => 'Diesel'], ['name' => 'Electricity', 'value' => 'Electricity']]],
            'transcription' => ['name' => 'Transcription', 'list' => [['name' => 'Automatic', 'value' => 'automatique'], ['name' => 'Manuel', 'value' => 'manuel']]],
        ];
        $marques=Marque::all();
        $categories=Categorie::all();
        return view('car.create',compact('marques','categories','content'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required',
            'model' => 'required',
            'color' => 'required',
            'carburant' => 'required',
            'categorie' => 'required',
            'GPSCode' => 'nullable',
            'phoneGPS' => 'nullable',
            'etat' => 'nullable',
            'nrchassis' => 'nullable',
            'immatriculationWW' => 'nullable',
            'immatriculation1' => 'nullable',
            'lettre' => 'nullable',
            'immatriculation2' => 'nullable',
            'km' => 'nullable|numeric',
            'transcription' => 'nullable',
            'puissance' => 'nullable|numeric',
            'nbplace' => 'nullable|integer',
            'kmjr' => 'nullable|numeric',
            'kmvidange' => 'nullable|numeric',
            'price_1' => 'nullable|numeric',
            'price_2' => 'nullable|numeric',
            'cartegrise' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'autorisation' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'joint' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'issurrance' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'control' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vignette' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_validite_autorisation' => 'nullable|date',
            'date_validite_vignette' => 'nullable|date',
            'date_validite_issurrance' => 'nullable|date',
            'date_validite_CG' => 'nullable|date',
            'date_validite_control' => 'nullable|date',
            'status' => 'nullable',
            'agency' => 'nullable',
            'sous_price' => 'nullable|numeric',
            'date_sous_location' => 'nullable|date',
            'provider' => 'nullable',
            'date_achat' => 'nullable|date',
            'date_traite_achat' => 'nullable|date',
            'prix_achat' => 'nullable|numeric',
            'avance_achat' => 'nullable|numeric',
            'duree_achat' => 'nullable|numeric',
        ]);

        $car = new Car();
        $car->model = $request->model;
        $car->agence_id = Auth::user()->id;
        $car->color = $request->color;
        $car->categorie = $request->categorie;
        $car->carburant = $request->carburant;
        $car->GPSCode = $request->GPSCode;
        $car->phoneGPS = $request->phoneGPS;
        $car->etat = $request->etat;
        $car->nrchassis = $request->nrchassis;
        $car->immatriculationWW = $request->immatriculationWW;
        $car->immatriculation1 = $request->immatriculation1;
        $car->lettre = $request->lettre;
        $car->immatriculation2 = $request->immatriculation2;
        $car->km = $request->km;
        $car->transcription = $request->transcription;
        $car->puissance = $request->puissance;
        $car->nbplace = $request->nbplace;
        $car->kmjr = $request->kmjr;
        $car->kmvidange = $request->kmvidange;
        $car->price_1 = $request->price_1;
        $car->price_2 = $request->price_2;

        if ($request->hasFile('cartegrise')) {
            $cartegrisePath = $request->file('cartegrise')->store('cars/cartegrise', 'public');
            $car->cartegrise = $cartegrisePath;
        }
        if ($request->hasFile('autorisation')) {
            $autorisationPath = $request->file('autorisation')->store('cars/autorisation', 'public');
            $car->autorisation = $autorisationPath;
        }
        if ($request->hasFile('joint')) {
            $jointPath = $request->file('joint')->store('cars/joint', 'public');
            $car->joint = $jointPath;
        }
        if ($request->hasFile('issurrance')) {
            $issurrancePath = $request->file('issurrance')->store('cars/issurrance', 'public');
            $car->issurrance = $issurrancePath;
        }
        if ($request->hasFile('control')) {
            $controlPath = $request->file('control')->store('cars/control', 'public');
            $car->control = $controlPath;
        }
        if ($request->hasFile('vignette')) {
            $vignettePath = $request->file('vignette')->store('cars/vignette', 'public');
            $car->vignette = $vignettePath;
        }

        $car->date_validite_autorisation = $request->date_validite_autorisation;
        $car->date_validite_vignette = $request->date_validite_vignette;
        $car->date_validite_issurrance = $request->date_validite_issurrance;
        $car->date_validite_CG = $request->date_validite_CG;
        $car->date_validite_control = $request->date_validite_control;

        switch ($request->status) {
            case 'Sous Location':
                $car->status = 'Sous Location';
                $car->agency = $request->agency;
                $car->sous_price = $request->sous_price;
                $car->date_sous_location = $request->date_sous_location;
                break;
            case 'credit':
                $car->status = 'credit';
                $car->provider = $request->provider;
                $car->date_achat = $request->date_achat;
                $car->date_traite_achat = $request->date_traite_achat;
                $car->prix_achat = $request->prix_achat;
                $car->avance_achat = $request->avance_achat;
                $car->duree_achat = $request->duree_achat;
                break;
            default:
                $car->status = 'Completed';
                break;
        }

        $car->save();

        if ($car->GPSCode) {
            //TraccarController::storeDevice($car);
        }

        return redirect()->route('cars.index')->with('success', 'Car added successfully');
    }


    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'marque' => 'required',
            'model' => 'required',
            'color' => 'required',
            'carburant' => 'required',
            'categorie' => 'required',
            'GPSCode' => 'nullable',
            'phoneGPS' => 'nullable',
            'etat' => 'nullable',
            'nrchassis' => 'nullable',
            'immatriculationWW' => 'nullable',
            'immatriculation1' => 'nullable',
            'lettre' => 'nullable',
            'immatriculation2' => 'nullable',
            'km' => 'nullable|numeric',
            'transcription' => 'nullable',
            'puissance' => 'nullable|numeric',
            'nbplace' => 'nullable|integer',
            'kmjr' => 'nullable|numeric',
            'kmvidange' => 'nullable|numeric',
            'price_1' => 'nullable|numeric',
            'price_2' => 'nullable|numeric',
            'cartegrise' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'autorisation' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'joint' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'issurrance' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'control' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vignette' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'date_validite_autorisation' => 'nullable|date',
            'date_validite_vignette' => 'nullable|date',
            'date_validite_issurrance' => 'nullable|date',
            'date_validite_CG' => 'nullable|date',
            'date_validite_control' => 'nullable|date',
            'status' => 'nullable',
            'agency' => 'nullable',
            'sous_price' => 'nullable|numeric',
            'date_sous_location' => 'nullable|date',
            'provider' => 'nullable',
            'date_achat' => 'nullable|date',
            'date_traite_achat' => 'nullable|date',
            'prix_achat' => 'nullable|numeric',
            'avance_achat' => 'nullable|numeric',
            'duree_achat' => 'nullable|numeric',
        ]);

        $car->update($request->all());

        // Handle file uploads if new files are provided
        if ($request->hasFile('cartegrise')) {
            $cartegrisePath = $request->file('cartegrise')->store('cars/cartegrise', 'public');
            $car->cartegrise = $cartegrisePath;
        }
        if ($request->hasFile('autorisation')) {
            $autorisationPath = $request->file('autorisation')->store('cars/autorisation', 'public');
            $car->autorisation = $autorisationPath;
        }
        if ($request->hasFile('joint')) {
            $jointPath = $request->file('joint')->store('cars/joint', 'public');
            $car->joint = $jointPath;
        }
        if ($request->hasFile('issurrance')) {
            $issurrancePath = $request->file('issurrance')->store('cars/issurrance', 'public');
            $car->issurrance = $issurrancePath;
        }
        if ($request->hasFile('control')) {
            $controlPath = $request->file('control')->store('cars/control', 'public');
            $car->control = $controlPath;
        }
        if ($request->hasFile('vignette')) {
            $vignettePath = $request->file('vignette')->store('cars/vignette', 'public');
            $car->vignette = $vignettePath;
        }

        // Save the updated car data
        $car->save();

        return redirect()->route('cars.index')->with('success', 'Car updated successfully');
    }


    public function destroy(Car $car)
    {
        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully');
    }
}
