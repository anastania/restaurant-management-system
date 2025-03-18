<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::latest()->paginate(10);
        return view('promo-codes.index', compact('promoCodes'));
    }

    public function create()
    {
        return view('promo-codes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes',
            'discount' => 'required|numeric|min:0',
            'type' => 'required|in:fixed,percentage',
            'valid_until' => 'nullable|date|after:today',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        PromoCode::create($validated);

        return redirect()->route('promocodes.index')
            ->with('success', 'Promo code created successfully');
    }

    public function edit(PromoCode $promoCode)
    {
        return view('promo-codes.edit', compact('promoCode'));
    }

    public function update(Request $request, PromoCode $promoCode)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:promo_codes,code,' . $promoCode->id,
            'discount' => 'required|numeric|min:0',
            'type' => 'required|in:fixed,percentage',
            'valid_until' => 'nullable|date|after:today',
            'is_active' => 'boolean'
        ]);

        $validated['is_active'] = $request->has('is_active');

        $promoCode->update($validated);

        return redirect()->route('promocodes.index')
            ->with('success', 'Promo code updated successfully');
    }

    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();

        return redirect()->route('promocodes.index')
            ->with('success', 'Promo code deleted successfully');
    }
}
