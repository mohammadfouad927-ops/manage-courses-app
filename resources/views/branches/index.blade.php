@extends('layout.starter-en')

@section('title', 'Branches')

@section('path', 'Branches')

@section('pageName', 'Branches')

@section('content')

    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm rounded-lg">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 font-weight-bold text-primary">Branches Management</h5>
                    <p class="text-muted small mb-0">Manage your physical locations and map details</p>
                </div>
                <a href="{{route('branches.create')}}" class="btn btn-primary btn-sm px-4 shadow-sm ml-auto">
                    <i class="fas fa-plus-circle mr-1"></i> Add New Branch
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="text-secondary small text-uppercase font-weight-bold">
                                <th class="py-3 px-4 border-0">Branch Name</th>
                                <th class="py-3 border-0">Address</th>
                                <th class="py-3 border-0">Location</th>
                                <th class="py-3 border-0">Status</th>
                                <th class="py-3 px-4 border-0 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($branches as $branch)
                            <tr>
                                <td class="px-4">
                                    <span class="font-weight-bold text-dark">{{ $branch->name }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small">{{ Str::limit($branch->address, 50) }}</span>
                                </td>
                                <td>
                                    @if($branch->googleMapLink)
                                    <a href="{{ $branch->googleMapLink }}" target="_blank" class="btn btn-sm bg-soft-info rounded-pill px-3">
                                        <i class="fas fa-map-marker-alt mr-1"></i> View Map
                                    </a>
                                    @else
                                    <span class="text-muted small italic">No link</span>
                                    @endif
                                </td>
                                <td>
                                    @if($branch->isActive)
                                        <span class="badge bg-soft-success px-3 py-2 rounded-pill">Active</span>
                                    @else
                                        <span class="badge bg-soft-danger px-3 py-2 rounded-pill">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-4 text-center">
                                    <div class="btn-group shadow-sm rounded">
                                        <a href="{{ route('branches.edit', $branch) }}" class="btn btn-white btn-sm border">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>
                                        
                                        <form action="{{ route('branches.destroy', $branch) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm border border-left-0" 
                                                    onclick="return confirm('Are you sure you want to delete this branch?');" 
                                                    title="Delete Branch">
                                                <i class="fas fa-trash-alt text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="fas fa-store-slash fa-3x mb-3 opacity-2"></i>
                                        <p>No branches added yet.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection