<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ingredients = Ingredient::latest()->paginate(10);
        return view('ingredients.index', compact('ingredients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ingredients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ingredients',
            'description' => 'nullable|string',
            'stock' => 'required|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'unit' => 'required|string|max:50',
            'minimum_stock' => 'nullable|integer|min:0'
        ]);

        $validated['active'] = true;

        Ingredient::create($validated);

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:ingredients,name,' . $ingredient->id,
            'description' => 'nullable|string',
            'stock' => 'required|numeric|min:0',
            'cost' => 'nullable|numeric|min:0',
            'unit' => 'required|string|max:50',
            'minimum_stock' => 'nullable|integer|min:0',
            'active' => 'boolean'
        ]);

        $ingredient->update($validated);

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredients.index')
            ->with('success', 'Ingredient deleted successfully');
    }

    public function updateStock(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'adjustment' => 'required|integer',
            'note' => 'nullable|string'
        ]);

        $newStock = $ingredient->stock + $validated['adjustment'];
        
        if ($newStock < 0) {
            return back()->with('error', 'Stock cannot be negative');
        }

        $ingredient->update(['stock' => $newStock]);

        return back()->with('success', 'Stock updated successfully');
    }
}
