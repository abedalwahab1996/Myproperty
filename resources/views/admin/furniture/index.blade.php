@extends('layouts.dashboard')

@section('title', 'Manage Furniture')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-couch text-warning me-2"></i> Furniture Management
                    </h4>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Stock</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($furniture as $furniture)
                                <tr>
                            <td>
                                @if($furniture->primaryImage)
                                    <img src="{{ asset('storage/'.$furniture->primaryImage->path) }}"
                                         alt="Thumbnail"
                                         class="img-thumbnail">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $furniture->name }}</td>
                                    <td>{{ Str::limit($furniture->description, 50) }}</td>
                                    <td>{{ $furniture->stock }}</td>
                                    <td>${{ number_format($furniture->price, 2) }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.furniture.destroy', $furniture->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this furniture?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">No furniture found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Auto-dismiss alerts after 5 seconds
    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 5000);
</script>
@endpush
