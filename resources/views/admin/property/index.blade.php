@extends('layouts.dashboard')

@section('content')
<div class="container-fluid px-4 property-management">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 mb-0">Property Management</h1>
    </div>

    <!-- Properties Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 fw-bold">
                <i class="fas fa-home me-2"></i> All Properties ({{ $properties->total() }})
            </h6>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => '']) }}">All</a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'active']) }}">Active</a></li>
                    <li><a class="dropdown-item" href="{{ request()->fullUrlWithQuery(['status' => 'pending']) }}">Pending</a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Location</th>
                            <th>Owner</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($properties as $property)
                        <tr>
                            <td>{{ $property->id }}</td>
                            <td>
                                @if($property->primaryImage)
                                    <img src="{{ asset('storage/'.$property->primaryImage->path) }}"
                                         alt="Thumbnail"
                                         class="img-thumbnail">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($property->name, 30) }}</td>
                            <td>JOD {{ number_format($property->price) }}</td>
                            <td>{{ Str::limit($property->address, 25) }}</td>
                            <td>{{ $property->user->name }}</td>
                            <td>
                                <div class="d-flex gap-2">

                                <form action="{{ route('admin.property.destroy', $property->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">No properties found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($properties->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $properties->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include SweetAlert if not already included in your layout -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // JavaScript code from above
</script>
@endsection
