<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('active', true)->get();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'variants' => 'nullable|json'
        ]);

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = Storage::url($path);
            }
            $validated['images'] = json_encode($images);
        }

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produit créé avec succès.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('active', true)->get();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'variants' => 'nullable|json'
        ]);

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $images[] = Storage::url($path);
            }
            $validated['images'] = json_encode($images);
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        if ($product->images) {
            $images = json_decode($product->images);
            foreach ($images as $image) {
                Storage::delete('public/' . str_replace('/storage/', '', $image));
            }
        }
        
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }

    public function updateStock(Request $request, Product $product)
    {
        $validated = $request->validate([
            'stock' => 'required|integer|min:0'
        ]);

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Stock mis à jour avec succès.');
    }
}
