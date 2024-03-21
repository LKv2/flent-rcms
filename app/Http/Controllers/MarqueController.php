<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    public function index()
    {
        $marques = Marque::all();
        return view('marque.index', compact('marques'));
    }

    public function create()
    {
        return view('marques.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $logoPath = '';
        if ($request->hasFile('file')) {
            $logoPath = $request->file('file')->store('/marque_logos', 'public');
        }

        Marque::create([
            'name' => $request->name,
            'logo' => $logoPath
        ]);

        return redirect()->route('marques.index')
            ->with('success', 'Marque created successfully.');
    }

    public function edit(Marque $marque)
    {
        return view('marques.edit', compact('marque'));
    }

    public function update(Request $request, Marque $marque)
    {
        $request->validate([
            'name' => 'required',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $logoPath = $request->file('file')->store('/marque_logos', 'public');
            $marque->logo = $logoPath;
        }

        $marque->name = $request->name;
        $marque->save();

        return redirect()->route('marques.index')
            ->with('success', 'Marque updated successfully');
    }

    public function destroy(Marque $marque)
    {
        $marque->delete();

        return redirect()->route('marques.index')
            ->with('success', 'Marque deleted successfully');
    }
}
