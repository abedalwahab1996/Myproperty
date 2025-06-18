@extends('layouts.user')

@section('content')
<div class="container-fluid px-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0 fw-bold">My Properties</h5>
        <a href="{{ route('user.property.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Add Property
        </a>
    </div>

    <!-- Properties Card Grid -->
    <div class="card shadow-sm border-0">
        @if($properties->isEmpty())
            <div class="card-body text-center py-5">
                <div class="empty-state">
                    <i class="fas fa-home fa-3x text-muted mb-3"></i>
                    <h5 class="fw-bold">No Properties Found</h5>
                    <p class="text-muted">You haven't listed any properties yet.</p>
                    <a href="{{ route('user.property.create') }}" class="btn btn-primary mt-3">
                        <i class="fas fa-plus me-1"></i> Create Your First Listing
                    </a>
                </div>
            </div>
        @else
            <div class="card-body p-3">
                <div class="row g-3">
                    @foreach($properties as $property)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm hover-shadow-lg transition-all">
                            <div class="position-relative">
                                @if($property->primaryImage)
                                    <img src="{{ asset('storage/'.$property->primaryImage->path) }}"
                                         class="card-img-top"
                                         alt="{{ $property->name }}"
                                         style="height: 180px; object-fit: cover;">
                                @else
                                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center"
                                         style="height: 180px;">
                                        <i class="fas fa-home fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <span class="badge bg-primary position-absolute top-0 end-0 m-2">
                                    JOD {{ number_format($property->price) }}
                                </span>
                            </div>

                            <div class="card-body p-3">
                                <h6 class="card-title fw-bold mb-1 text-truncate">{{ $property->name }}</h6>
                                <p class="card-text small text-muted mb-2">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                    {{ Str::limit($property->address, 40) }}
                                </p>

                                <div class="d-flex justify-content-between small mb-2">
                                    <span class="text-nowrap">
                                        <i class="fas fa-ruler-combined me-1"></i> {{ $property->area ?? 'N/A' }} m²
                                    </span>
                                    <span class="text-nowrap">
                                        <i class="fas fa-phone me-1"></i> {{ $property->number }}
                                    </span>
                                </div>

                                <p class="card-text small text-muted mb-3">{{ Str::limit($property->description, 80) }}</p>
                            </div>

                            <div class="card-footer bg-white px-3 py-2 border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex">
                                        <a href="{{ route('user.property.edit', $property->id) }}"
                                           class="btn btn-sm btn-outline-warning rounded-pill px-3 me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('user.property.destroy', $property->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                                    onclick="return confirm('Are you sure you want to delete this property?')">
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
            </div>

            <!-- Pagination -->
            <div class="card-footer bg-white py-3">
                <div class="d-flex justify-content-center">
                    {{ $properties->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }
    .empty-state {
        max-width: 500px;
        margin: 0 auto;
    }
</style>
@endpush
