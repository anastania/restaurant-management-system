<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('active', true)->get();
        $featuredProducts = Product::where('active', true)
            ->with('category')
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('categories', 'featuredProducts'));
    }

    public function dashboard()
    {
        $totalProducts = Product::count();
        $activeCategories = Category::where('active', true)->count();
        $lowStockProducts = Product::where('stock', '<', 10)->count();

        return view('admin.dashboard', compact('totalProducts', 'activeCategories', 'lowStockProducts'));
    }
}
