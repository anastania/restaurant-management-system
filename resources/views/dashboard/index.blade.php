@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Tableau de bord</h1>
        <div class="d-flex gap-2">
            <div class="position-relative">
                <i class="bi bi-bell text-muted"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    2
                </span>
            </div>
            <div class="dropdown">
                <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-gear"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Paramètres</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Commandes</h6>
                    <h3 class="mb-0">{{ $stats['total_orders'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Produits</h6>
                    <h3 class="mb-0">{{ $stats['total_products'] }}</h3>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="text-muted mb-2">Total Catégories</h6>
                    <h3 class="mb-0">{{ $stats['total_categories'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Orders -->
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Commandes Récentes</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Numéro</th>
                                    <th>Client</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['recent_orders'] as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ number_format($order->total, 2) }} €</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status === 'completed' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popular Products -->
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="card-title mb-0">Produits Populaires</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>Catégorie</th>
                                    <th>Prix</th>
                                    <th>Commandes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stats['popular_products'] as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($product->images)
                                                <img src="{{ json_decode($product->images)[0] }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="rounded-circle me-2"
                                                     width="32"
                                                     height="32">
                                            @endif
                                            {{ $product->name }}
                                        </div>
                                    </td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ number_format($product->price, 2) }} €</td>
                                    <td>{{ $product->order_items_count }}</td>
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
