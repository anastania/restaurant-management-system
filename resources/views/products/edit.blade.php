@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Modifier le Produit</h1>
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Retour
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nom du produit</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $product->name) }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Catégorie</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" 
                                            id="category_id" 
                                            name="category_id" 
                                            required>
                                        <option value="">Sélectionner une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Prix (€)</label>
                                    <input type="number" 
                                           class="form-control @error('price') is-invalid @enderror" 
                                           id="price" 
                                           name="price" 
                                           value="{{ old('price', $product->price) }}" 
                                           step="0.01" 
                                           min="0" 
                                           required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" 
                                           class="form-control @error('stock') is-invalid @enderror" 
                                           id="stock" 
                                           name="stock" 
                                           value="{{ old('stock', $product->stock) }}" 
                                           min="0" 
                                           required>
                                    @error('stock')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Variantes</label>
                            <div class="card">
                                <div class="card-body">
                                    @php
                                        $variants = json_decode($product->variants, true) ?? ['sizes' => [], 'options' => []];
                                    @endphp
                                    <div class="mb-3">
                                        <label class="form-label">Tailles disponibles</label>
                                        <div class="d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="sizes[]" 
                                                       value="Normal" 
                                                       id="sizeNormal"
                                                       {{ in_array('Normal', $variants['sizes'] ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="sizeNormal">Normal</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="sizes[]" 
                                                       value="Large" 
                                                       id="sizeLarge"
                                                       {{ in_array('Large', $variants['sizes'] ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="sizeLarge">Large</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label">Options</label>
                                        <div class="d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="options[]" 
                                                       value="Extra fromage" 
                                                       id="optionCheese"
                                                       {{ in_array('Extra fromage', $variants['options'] ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="optionCheese">Extra fromage</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="options[]" 
                                                       value="Épicé" 
                                                       id="optionSpicy"
                                                       {{ in_array('Épicé', $variants['options'] ?? []) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="optionSpicy">Épicé</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Images du produit</label>
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <input type="file" 
                                               class="form-control @error('images') is-invalid @enderror" 
                                               name="images[]" 
                                               accept="image/*" 
                                               multiple>
                                        @error('images')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div id="imagePreview" class="d-flex flex-wrap gap-2">
                                        @if($product->images)
                                            @foreach(json_decode($product->images) as $image)
                                                <img src="{{ $image }}" 
                                                     alt="{{ $product->name }}"
                                                     class="rounded"
                                                     style="width: 100px; height: 100px; object-fit: cover;">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <button type="reset" class="btn btn-outline-secondary">Réinitialiser</button>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.querySelector('input[type="file"]').addEventListener('change', function(e) {
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';
    
    for (const file of this.files) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.classList.add('rounded');
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.objectFit = 'cover';
            preview.appendChild(img);
        }
        reader.readAsDataURL(file);
    }
});

document.querySelector('form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Get selected sizes and options
    const sizes = Array.from(document.querySelectorAll('input[name="sizes[]"]:checked')).map(cb => cb.value);
    const options = Array.from(document.querySelectorAll('input[name="options[]"]:checked')).map(cb => cb.value);
    
    // Create variants JSON
    const variants = {
        sizes: sizes,
        options: options
    };
    
    // Add variants to form
    const variantsInput = document.createElement('input');
    variantsInput.type = 'hidden';
    variantsInput.name = 'variants';
    variantsInput.value = JSON.stringify(variants);
    this.appendChild(variantsInput);
    
    this.submit();
});
</script>
@endpush
@endsection
