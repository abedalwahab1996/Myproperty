@extends('layouts.user')

@section('title', 'My Furniture')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <a href="{{ route('user.furniture.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Furniture
            </a>
        </div>
    </div>

    @if($furniture->isEmpty())
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> No furniture items found. Start by adding your first item.
        </div>
    @else
        <div class="row">
            @foreach($furniture as $item)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Furniture Image -->
@if($item->image)
    <img src="{{ $item->image->url }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Furniture Image">
@else
    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
        <i class="fas fa-couch fa-4x text-muted"></i>
    </div>
@endif


                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <h5 class="card-title mb-1">{{ $item->name }}</h5>
                                <span class="badge bg-{{ $item->stock > 0 ? 'success' : 'danger' }}">
                                    {{ $item->stock }} in stock
                                </span>
                            </div>
                            <p class="card-text text-muted small">{{ Str::limit($item->description, 100) }}</p>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">JOD{{ number_format($item->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $furniture->links() }}
        </div>
    @endif
</div>
@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Any additional JavaScript for this page
    });
</script>
@endpush
