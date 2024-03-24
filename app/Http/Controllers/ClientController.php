<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('client.index', compact('clients'));
    }
    public function create()
    {
        return view('client.create');
    }
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('client.edite', compact('client'));
    }
    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->fname . ' ' . $request->lname,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'activation' => true,
        ]);

        // Create a new client
        $client = Client::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'agence_id' => Auth::user()->id,
            'phone' => $request->phone,
            'adresse' => $request->adresse,
            'cin' => $request->cin,
            'date_naissance' => $request->date_naissance ? $request->date_naissance : null,
            'nationalite' => $request->nationalite ? $request->nationalite : null,
            'ville' => $request->ville ? $request->ville : null,
            'passport' => $request->passport ? $request->passport : null,
            'permis' => $request->permis,
            'CDelivre_date' => $request->CDelivre_date,
            'CValide_date' => $request->CValide_date,
            'PDelivre_date' => $request->PDelivre_date,
            'PassDelivre_date' => $request->PassDelivre_date ? $request->PassDelivre_date : null,
            'PassValide_date' => $request->PassValide_date ? $request->PassValide_date : null,
            'PValide_date' => $request->PValide_date,
            'user' => $user->id,
        ]);

        // Handle file uploads
        if ($request->hasFile('file_input_C')) {
            $file_input_C = $request->file('file_input_C')->store('/CIN', 'public');
            $client->file_input_C = $file_input_C;
        }
        if ($request->hasFile('file_input_Pass')) {
            $file_input_Pass = $request->file('file_input_Pass')->store('/Passport', 'public');
            $client->file_input_Pass = $file_input_Pass;
        }

        if ($request->hasFile('file_input_P')) {
            $file_input_P = $request->file('file_input_P')->store('/Permis', 'public');
            $client->file_input_P = $file_input_P;
        }
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }
    public function update(Request $request, $id)
    {


        // Create a new client
        $client = Client::findOrFail($id);
        $client->fname = $request->fname;
        $client->lname = $request->lname;
        $client->phone = $request->phone;
        $client->adresse = $request->adresse;
        $client->cin = $request->cin;
        $client->permis = $request->permis;
        $client->CDelivre_date = $request->CDelivre_date;
        $client->CValide_date = $request->CValide_date;
        $client->PDelivre_date = $request->PDelivre_date;
        $client->PValide_date = $request->PValide_date;
        $client->date_naissance = $request->date_naissance ? $request->date_naissance : null;
        $client->nationalite = $request->nationalite ? $request->nationalite : null;
        $client->ville = $request->ville ? $request->ville : null;
        $client->passport = $request->passport ? $request->passport : null;
        $client->PassDelivre_date = $request->PassDelivre_date ? $request->PassDelivre_date : null;
        $client->PassValide_date = $request->PassValide_date ? $request->PassValide_date : null;


        // Handle file uploads
        if ($request->hasFile('file_input_Pass')) {
            $file_input_Pass = $request->file('file_input_Pass')->store('/Passport', 'public');
            Storage::delete($client->file_input_Pass);
            $client->file_input_Pass = $file_input_Pass;
        }
        if ($request->hasFile('file_input_C')) {
            $file_input_C = $request->file('file_input_C')->store('/CIN', 'public');
            Storage::delete($client->file_input_P);
            $client->file_input_C = $file_input_C;
        }

        if ($request->hasFile('file_input_P')) {
            $file_input_P = $request->file('file_input_P')->store('/Permis', 'public');
            Storage::delete($client->file_input_P);
            $client->file_input_P = $file_input_P;
        }
        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }
    public function show($id)
    {
        $client = Client::find($id);
        //$bookings=$client->bookings();
        return view('client.show', compact('client'));
    }
    public function document($id, $type)
    {
        $client = Client::findOrFail($id);
        return view('client.document', compact('client', 'type'));
    }
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Client deleted successfully');
    }
}
