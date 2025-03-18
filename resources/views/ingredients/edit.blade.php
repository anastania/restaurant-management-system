@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Ingredient</h2>
        <a href="{{ route('ingredients.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Ingredients
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('ingredients.update', $ingredient) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $ingredient->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', $ingredient->stock) }}" required min="0" step="0.01">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="unit" class="form-label">Unit</label>
                    <input type="text" class="form-control @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ old('unit', $ingredient->unit) }}" required>
                    @error('unit')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Update Ingredient</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
