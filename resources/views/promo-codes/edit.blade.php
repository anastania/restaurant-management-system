@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Promo Code</h2>
        <a href="{{ route('promocodes.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Promo Codes
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('promocodes.update', $promoCode) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $promoCode->code) }}" required>
                    @error('code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="number" class="form-control @error('discount') is-invalid @enderror" id="discount" name="discount" value="{{ old('discount', $promoCode->discount) }}" required min="0" step="0.01">
                    @error('discount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                        <option value="fixed" {{ (old('type', $promoCode->type) === 'fixed') ? 'selected' : '' }}>Fixed Amount (SAR)</option>
                        <option value="percentage" {{ (old('type', $promoCode->type) === 'percentage') ? 'selected' : '' }}>Percentage (%)</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="valid_until" class="form-label">Valid Until</label>
                    <input type="date" class="form-control @error('valid_until') is-invalid @enderror" id="valid_until" name="valid_until" value="{{ old('valid_until', $promoCode->valid_until ? $promoCode->valid_until->format('Y-m-d') : '') }}">
                    @error('valid_until')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input @error('is_active') is-invalid @enderror" id="is_active" name="is_active" value="1" {{ old('is_active', $promoCode->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Active</label>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Update Promo Code</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
