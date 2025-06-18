@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Edit Property</h4>
                    <a href="{{ route('user.property.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Properties
                    </a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.property.update', $property->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Property Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Property Name *</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $property->name) }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror"
                                      rows="4">{{ old('description', $property->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        @if($property->primaryImage)
                        <div class="mb-3">
                            <label class="form-label">Current Image</label>
                            <div class="border p-2 rounded" style="max-width: 300px;">
                                <img src="{{ asset('storage/' . $property->primaryImage->path) }}" alt="Property Image" class="img-fluid rounded">
                                <div class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image">
                                    <label class="form-check-label text-danger" for="remove_image">
                                        Remove current image
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="image" class="form-label">
                                {{ $property->primaryImage ? 'Change Property Image' : 'Upload Property Image' }}
                            </label>
                            <input type="file" id="image" name="image"
                                   class="form-control @error('image') is-invalid @enderror"
                                   accept="image/jpeg,image/png,image/jpg,image/gif">
                            @error('image')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <div class="form-text text-muted">
                                Accepted formats: JPEG, PNG, GIF. Max size: 2MB. Recommended dimensions: 800x600px.
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address *</label>
                            <input type="text" id="address" name="address"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{ old('address', $property->address) }}" required>
                            @error('address')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <!-- Price -->
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price (JOD) *</label>
                                <div class="input-group">
                                    <span class="input-group-text">JOD</span>
                                    <input type="number" id="price" name="price"
                                           class="form-control @error('price') is-invalid @enderror"
                                           value="{{ old('price', $property->price) }}" step="0.01" min="0" required>
                                </div>
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Area -->
                            <div class="col-md-6 mb-3">
                                <label for="area" class="form-label">Area (m²)</label>
                                <div class="input-group">
                                    <span class="input-group-text">m²</span>
                                    <input type="number" id="area" name="area"
                                           class="form-control @error('area') is-invalid @enderror"
                                           value="{{ old('area', $property->area) }}" step="0.01" min="0">
                                </div>
                                @error('area')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-4">
                            <label for="number" class="form-label">Contact Number *</label>
                            <input type="tel" id="number" name="number"
                                   class="form-control @error('number') is-invalid @enderror"
                                   value="{{ old('number', $property->number) }}" required>
                            @error('number')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Publish Status -->
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_publish" name="is_publish"
                                       value="1" {{ old('is_publish', $property->is_publish) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_publish">Publish this property</label>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <button type="button" class="btn btn-outline-danger" id="delete-property-btn">
                                <i class="fas fa-trash-alt me-2"></i> Delete Property
                            </button>

                            <div class="d-flex">
                                <a href="{{ route('user.property.index') }}" class="btn btn-outline-secondary me-2">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i> Update Property
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Delete Form (Hidden) -->
                    <form id="delete-form" action="{{ route('user.property.destroy', $property->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

