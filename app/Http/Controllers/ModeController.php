<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use App\Models\Mode;
use Illuminate\Http\Request;

class ModeController extends Controller
{
    public function index()
    {
        $marques=Marque::all();
        $modes = Mode::all();
        return view('mode.index', compact('modes','marques'));
    }

    public function create()
    {
        return view('mode.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'marque' => 'required',
            'name' => 'required',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'front_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'exterior_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mode = new Mode();
        $mode->marque = $request->marque;
        $mode->name = $request->name;
        $mode->year = $request->year;

        $frontImagePath = $request->file('front_image')->store('/mode_images', 'public');
        $mode->front_image = $frontImagePath;

        $backImagePath = $request->file('back_image')->store('/mode_images', 'public');
        $mode->back_image = $backImagePath;

        $interiorImagePath = $request->file('interior_image')->store('/mode_images', 'public');
        $mode->interior_image = $interiorImagePath;

        $exteriorImagePath = $request->file('exterior_image')->store('/mode_images', 'public');
        $mode->exterior_image = $exteriorImagePath;

        $mode->save();

        return redirect()->route('modes.index')
            ->with('success', 'Mode created successfully.');
    }

    public function edit(Mode $mode)
    {
        return view('mode.edit', compact('mode'));
    }

    public function update(Request $request, Mode $mode)
    {
        $request->validate([
            'marque' => 'required',
            'name' => 'required',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'back_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'interior_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'exterior_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $mode->marque = $request->marque;
        $mode->name = $request->name;
        $mode->year = $request->year;

        if ($request->hasFile('front_image')) {
            $frontImagePath = $request->file('front_image')->store('/mode_images', 'public');
            $mode->front_image = $frontImagePath;
        }

        if ($request->hasFile('back_image')) {
            $backImagePath = $request->file('back_image')->store('/mode_images', 'public');
            $mode->back_image = $backImagePath;
        }

        if ($request->hasFile('interior_image')) {
            $interiorImagePath = $request->file('interior_image')->store('/mode_images', 'public');
            $mode->interior_image = $interiorImagePath;
        }

        if ($request->hasFile('exterior_image')) {
            $exteriorImagePath = $request->file('exterior_image')->store('/mode_images', 'public');
            $mode->exterior_image = $exteriorImagePath;
        }

        $mode->save();

        return redirect()->route('modes.index')
            ->with('success', 'Mode updated successfully');
    }

    public function destroy(Mode $mode)
    {
        $mode->delete();

        return redirect()->route('modes.index')
            ->with('success', 'Mode deleted successfully');
    }
    public function getModelOfBrand($id){
        $models = Mode::where('marque', $id)->get();
        return response()->json($models);
    }
}
