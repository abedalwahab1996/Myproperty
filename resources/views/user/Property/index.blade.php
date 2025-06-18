@extends('layouts.user')

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('user.property.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i>Add Property
        </a>
    </div>

    <!-- Properties Card Grid -->
    <div class="card shadow-sm">
                <div class="card-header bg-white py-3 border-bottom">
            <h6 class="m-0 fw-bold text-primary">
                <i class="fas fa-home me-2"></i> Your Listings ({{ $properties->total() }})
            </h6>
        </div>
        <div class="card-body p-3">
            <div class="row g-3">
                @foreach($properties as $property)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
<div class="position-relative">
    @if($property->primaryImage)
        <img src="{{ asset('storage/'.$property->primaryImage->path) }}"
             class="card-img-top"
             alt="Property Image"
             style="height: 150px; object-fit: cover;">
    @else
        <img src="https://via.placeholder.com/800x600?text=No+Image"
             class="card-img-top"
             alt="No Image"
             style="height: 150px; object-fit: cover;">
    @endif
    <span class="badge bg-primary position-absolute top-0 end-0 m-2">JOD {{ number_format($property->price) }}</span>
</div>
                        <div class="card-body p-3">
                            <h6 class="card-title fw-bold mb-1">{{ $property->name }}</h6>
                            <p class="card-text small text-muted mb-2">
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                {{ Str::limit($property->address, 40) }}
                            </p>

                            <div class="d-flex justify-content-between small mb-2">
                                <span><i class="fas fa-ruler-combined me-1"></i> {{ $property->area }} m²</span>
                                <span><i class="fas fa-phone me-1"></i> {{ $property->number }}</span>
                            </div>

                            <p class="card-text small text-muted mb-2">{{ Str::limit($property->description, 80) }}</p>
                        </div>
                        <div class="card-footer bg-white px-3 py-2 border-top-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-link btn-sm text-primary p-0">chat</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
