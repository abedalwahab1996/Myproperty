@extends('layouts.user')

@section('title', 'My Furniture')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">My Furniture Collection</h2>
        <div class="card-tools">
            <a href="{{ route('user.furniture.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Furniture
            </a>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fas fa-check"></i> {{ session('success') }}
            </div>
        @endif

        @if($furnitures->isEmpty())
            <div class="text-center py-5">
                <i class="fas fa-couch fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">No furniture items found</h4>
                <p class="text-muted">Get started by adding your first furniture item</p>
                <a href="{{ route('user.furniture.create') }}" class="btn btn-primary mt-3">
                    <i class="fas fa-plus"></i> Add Furniture
                </a>
            </div>
        @else
            <div class="row">
                @foreach($furnitures as $furniture)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-img-top position-relative">
                            @if($furniture->image)
                                <img src="{{ asset('storage/' . $furniture->image->path) }}"
                                     class="img-fluid"
                                     style="height: 200px; width: 100%; object-fit: cover;"
                                     alt="{{ $furniture->name }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <i class="fas fa-couch fa-3x text-muted"></i>
                                </div>
                            @endif
                            <span class="position-absolute top-0 end-0 m-2 badge {{ $furniture->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                {{ $furniture->stock }} in stock
                            </span>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">{{ $furniture->name }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($furniture->description, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="h5 text-primary">${{ number_format($furniture->price, 2) }}</span>
                                <div class="btn-group">
                                    <a href="{{ route('user.furniture.edit', $furniture->id) }}"
                                       class="btn btn-sm btn-outline-secondary"
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('user.furniture.destroy', $furniture->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Delete"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>


</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 0.5rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .card-title {
        font-weight: 600;
    }
    .badge {
        font-size: 0.75rem;
        font-weight: 500;
    }
    .card-img-top {
        border-top-left-radius: 0.5rem;
        border-top-right-radius: 0.5rem;
    }
</style>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Enable Bootstrap tooltips
        $('[title]').tooltip();
    });
</script>
@endpush
