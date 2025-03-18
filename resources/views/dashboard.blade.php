@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4">Dashboard</h1>

    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted">Total Produits</h6>
                            <h2 class="card-title mb-0">{{ App\Models\Product::count() }}</h2>
                        </div>
                        <div class="bg-primary text-white rounded-circle p-3">
                            <i class="bi bi-box fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted">Total Catégories</h6>
                            <h2 class="card-title mb-0">{{ App\Models\Category::count() }}</h2>
                        </div>
                        <div class="bg-success text-white rounded-circle p-3">
                            <i class="bi bi-grid fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted">Total Ingrédients</h6>
                            <h2 class="card-title mb-0">{{ App\Models\Ingredient::count() }}</h2>
                        </div>
                        <div class="bg-info text-white rounded-circle p-3">
                            <i class="bi bi-egg-fried fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-subtitle mb-2 text-muted">Total Commandes</h6>
                            <h2 class="card-title mb-0">{{ App\Models\Order::count() }}</h2>
                        </div>
                        <div class="bg-warning text-white rounded-circle p-3">
                            <i class="bi bi-cart fs-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Produits en Rupture de Stock</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Catégorie</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Product::where('stock', '<', 10)->get() as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        <span class="badge bg-danger">{{ $product->stock }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Dernières Commandes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Client</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(App\Models\Order::latest()->take(5)->get() as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->customer_name }}</td>
                                    <td>{{ number_format($order->total, 2) }} €</td>
                                    <td>
                                        @switch($order->status)
                                            @case('pending')
                                                <span class="badge bg-warning">En attente</span>
                                                @break
                                            @case('processing')
                                                <span class="badge bg-info">En cours</span>
                                                @break
                                            @case('completed')
                                                <span class="badge bg-success">Terminée</span>
                                                @break
                                            @default
                                                <span class="badge bg-secondary">{{ $order->status }}</span>
                                        @endswitch
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
