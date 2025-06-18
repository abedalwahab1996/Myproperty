@extends('layouts.user')


@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3>{{ $furniture->name }}</h3>
            <span class="badge bg-{{ $furniture->stock > 0 ? 'success' : 'danger' }}">
                {{ $furniture->stock }} in stock
            </span>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    @if($furniture->image)
                        <img src="{{ asset('storage/'.$furniture->image->path) }}"
                             class="img-fluid rounded"
                             alt="{{ $furniture->name }}">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center"
                             style="height: 300px;">
                            <i class="fas fa-couch fa-5x text-muted"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <h4 class="text-primary">Details</h4>
                    <p class="mb-3">{{ $furniture->description ?? 'No description' }}</p>

                    <div class="mb-3">
                        <h5>Price: <span class="text-success">JOD {{ number_format($furniture->price, 2) }}</span></h5>
                    </div>

                    <div class="mb-3">
                        <h5>Added: {{ $furniture->created_at->format('M d, Y') }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer bg-white">
            <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
                <div>
                    <a href="#"
                       class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
