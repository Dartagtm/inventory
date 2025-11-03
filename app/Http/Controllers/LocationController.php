<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Mengimpor model Product
use App\Models\Category; // Mengimpor model Category
use App\Models\Location; // Mengimpor model Location

class LocationController extends Controller
{
    public function index()
{
    $locations = Location::all();
    return view('locations.index', compact('locations'));
}

public function create()
{
    return view('locations.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Location::create($validated);

    return redirect()->route('locations.index');
}

public function edit($id)
{
    $location = Location::findOrFail($id);
    return view('locations.edit', compact('location'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $location = Location::findOrFail($id);
    $location->update($validated);

    return redirect()->route('locations.index');
}

public function destroy($id)
{
    $location = Location::findOrFail($id);
    $location->delete();

    return redirect()->route('locations.index');
}
public function show($id)
{
    $location = Location::findOrFail($id);
    return view('locations.show', compact('location'));
}
}
