@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Ingredients</h2>
        <a href="{{ route('ingredients.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add Ingredient
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
                            <th>Name</th>
                            <th>Stock</th>
                            <th>Unit</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ingredients as $ingredient)
                            <tr>
                                <td>{{ $ingredient->id }}</td>
                                <td>{{ $ingredient->name }}</td>
                                <td>
                                    <span class="badge {{ $ingredient->stock < 10 ? 'bg-danger' : 'bg-success' }}">
                                        {{ $ingredient->stock }}
                                    </span>
                                </td>
                                <td>{{ $ingredient->unit }}</td>
                                <td>{{ $ingredient->created_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('ingredients.edit', $ingredient) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this ingredient?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No ingredients found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $ingredients->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
