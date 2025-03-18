@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Promo Codes</h2>
        <a href="{{ route('promocodes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Promo Code
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>Type</th>
                            <th>Valid Until</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($promoCodes as $promoCode)
                            <tr>
                                <td>{{ $promoCode->id }}</td>
                                <td>{{ $promoCode->code }}</td>
                                <td>{{ $promoCode->discount }}{{ $promoCode->type === 'percentage' ? '%' : ' SAR' }}</td>
                                <td>{{ ucfirst($promoCode->type) }}</td>
                                <td>{{ $promoCode->valid_until ? $promoCode->valid_until->format('Y-m-d') : 'No expiry' }}</td>
                                <td>
                                    <span class="badge {{ $promoCode->is_active ? 'bg-success' : 'bg-danger' }}">
                                        {{ $promoCode->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('promocodes.edit', $promoCode) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('promocodes.destroy', $promoCode) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this promo code?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No promo codes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $promoCodes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
