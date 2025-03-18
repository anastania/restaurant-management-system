<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Ingredient;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
