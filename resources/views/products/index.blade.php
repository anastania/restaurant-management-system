@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Produits</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Nouveau Produit
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    @if($product->images)
                                        <img src="{{ json_decode($product->images)[0] }}" 
                                             alt="{{ $product->name }}" 
                                             class="rounded"
                                             width="50"
                                             height="50"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded" style="width: 50px; height: 50px;"></div>
                                    @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ number_format($product->price, 2) }} €</td>
                                <td>
                                    <form action="{{ route('products.update-stock', $product) }}" 
                                          method="POST" 
                                          class="d-flex align-items-center gap-2">
                                        @csrf
                                        @method('POST')
                                        <input type="number" 
                                               name="stock" 
                                               value="{{ $product->stock }}" 
                                               class="form-control form-control-sm"
                                               style="width: 80px;"
                                               min="0">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    @if($product->active)
                                        <span class="badge bg-success">Actif</span>
                                    @else
                                        <span class="badge bg-danger">Inactif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('products.edit', $product) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection