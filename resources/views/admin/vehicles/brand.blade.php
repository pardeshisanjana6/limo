@extends('admin.adminlayout') 

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Manage Brands</h1>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Brands</h6>
             <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                Add New Brand
            </button> 
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Vehicle Count</th> {{-- NEW: Vehicle Count Header --}}
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>{{ $brand->vehicles_count }}</td> {{-- NEW: Display Vehicle Count --}}
                            <td>{{ $brand->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <a href="{{ route('admin.brands.vehicles', $brand->id) }}" class="btn btn-primary btn-sm me-1">View Vehicles</a>

                                <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE') 
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete the brand: {{ $brand->name }}? This action cannot be undone.');">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No brands found.</td> 
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $brands->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addBrandModalLabel">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.brands.store') }}" method="POST">
                @csrf
                <input type="hidden" name="form_source" value="add_brand"> {{-- Identify form submission source --}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="brand_name">Brand Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="brand_name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Brand</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any() && (old('form_source') == 'add_brand'))
            var addBrandModal = new bootstrap.Modal(document.getElementById('addBrandModal'));
            addBrandModal.show();
        @endif
    });
</script>
@endpush
