@extends('layouts.user')

@section('title', 'Edit Furniture')

@section('content')
<div class="card">
    <div class="card-header">
        <h2 class="card-title">Edit Furniture Item</h2>
        <div class="card-tools">
            <a href="{{ route('user.furniture.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="card-body">
        <form action="{{ route('user.furniture.update', $furniture->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="name">Furniture Name *</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $furniture->name) }}" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" rows="3"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $furniture->description) }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">Price (JOD) *</label>
                                <input type="number" step="0.01" name="price" id="price"
                                       class="form-control @error('price') is-invalid @enderror"
                                       value="{{ old('price', $furniture->price) }}" required>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stock">Stock Quantity *</label>
                                <input type="number" name="stock" id="stock"
                                       class="form-control @error('stock') is-invalid @enderror"
                                       value="{{ old('stock', $furniture->stock) }}" required>
                                @error('stock')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label>Current Image</label>
                        <div class="mb-3">
                            @if($furniture->image)
                                <img src="{{ asset('storage/' . $furniture->image->path) }}"
                                     class="img-fluid rounded border"
                                     style="max-height: 200px; width: auto;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                     style="height: 200px;">
                                    <i class="fas fa-couch fa-3x text-muted"></i>
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="image">Change Image</label>
                            <input type="file" name="image" id="image"
                                   class="form-control-file @error('image') is-invalid @enderror"
                                   accept="image/*">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">
                                Max 2MB. Recommended size: 800x800px
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Furniture
                </button>
                <a href="{{ route('user.furniture.index') }}" class="btn btn-outline-secondary ml-2">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 0.5rem;
    }
    .card-title {
        font-weight: 600;
    }
    .form-group label {
        font-weight: 500;
    }
    .invalid-feedback {
        display: block;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Preview image before upload
        document.getElementById('image').addEventListener('change', function(event) {
            const output = document.createElement('img');
            output.className = 'img-fluid rounded border mt-2';
            output.style.maxHeight = '200px';
            output.style.width = 'auto';

            const currentPreview = document.querySelector('.current-image-preview');
            if (currentPreview) {
                currentPreview.remove();
            }

            const reader = new FileReader();
            reader.onload = function() {
                output.src = reader.result;
                document.querySelector('.form-group > .mb-3').appendChild(output);
                output.classList.add('current-image-preview');
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    });
</script>
@endpush
