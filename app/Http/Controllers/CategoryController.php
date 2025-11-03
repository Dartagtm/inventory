<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Mengimpor model Product
use App\Models\Category; // Mengimpor model Category
use App\Models\Location; // Mengimpor model Location

class CategoryController extends Controller
{
    public function index()
{
    $categories = Category::all();
    return view('categories.index', compact('categories'));
}

public function create()
{
    return view('categories.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    Category::create($validated);

    return redirect()->route('categories.index');
}

public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('categories.edit', compact('category'));
}

public function update(Request $request, $id)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category = Category::findOrFail($id);
    $category->update($validated);

    return redirect()->route('categories.index');
}

public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->route('categories.index');
}
public function show($id)
{
    $category = Category::findOrFail($id);
    return view('categories.show', compact('category'));
}

}