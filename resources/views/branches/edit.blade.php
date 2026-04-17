@extends('layout.starter-en')

@section('title', 'Edit Branch')

@section('path', 'Branches / Edit')

@section('pageName', 'Edit Branch')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="mb-3">
                    <a href="{{ route('branches.index') }}" class="text-muted small font-weight-bold text-uppercase">
                        <i class="fas fa-arrow-left mr-1"></i> Back to List
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-header bg-white border-0 py-4 px-4">
                        <h4 class="mb-0 font-weight-bold text-primary">Edit Branch: {{ $branch->name }}</h4>
                        <p class="text-muted mb-0">Modify the contact information or physical location of this branch.</p>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('branches.update', $branch) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="small text-uppercase font-weight-bold text-muted">Branch Name</label>
                                        <input type="text" name="name" class="form-control form-control-lg border-2 @error('name') is-invalid @enderror" 
                                               placeholder="e.g. Main Headquarters" value="{{ old('name', $branch->name) }}" required>
                                        @error('name')
                                            <span class="invalid-feedback d-block font-weight-bold">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="small text-uppercase font-weight-bold text-muted">Phone Number</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-phone text-muted"></i></span>
                                            </div>
                                            <input type="text" name="phoneNumber" class="form-control border-left-0 @error('phoneNumber') is-invalid @enderror" 
                                                   value="{{ old('phoneNumber', $branch->phoneNumber) }}" placeholder="+20 ...">
                                        </div>
                                        @error('phoneNumber')
                                            <span class="invalid-feedback d-block font-weight-bold">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="small text-uppercase font-weight-bold text-muted">Email Address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                                            </div>
                                            <input type="email" name="email" class="form-control border-left-0 @error('email') is-invalid @enderror" 
                                                   value="{{ old('email', $branch->email) }}" placeholder="branch@company.com">
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback d-block font-weight-bold">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label class="small text-uppercase font-weight-bold text-muted">Physical Address</label>
                                        <input type="text" name="address" class="form-control form-control-lg border-2 @error('address') is-invalid @enderror" 
                                               placeholder="Street name, Building No." value="{{ old('address', $branch->address) }}" required>
                                        @error('address')
                                            <span class="invalid-feedback d-block font-weight-bold">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="small text-uppercase font-weight-bold text-muted">Google Map Link</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-light border-right-0"><i class="fas fa-map-marked-alt text-muted"></i></span>
                                            </div>
                                            <input type="url" name="googleMapLink" class="form-control border-left-0 @error('googleMapLink') is-invalid @enderror" 
                                                   value="{{ old('googleMapLink', $branch->googleMapLink) }}" placeholder="https://maps.app.goo.gl/...">
                                        </div>
                                        @error('googleMapLink')
                                            <span class="invalid-feedback d-block font-weight-bold">
                                                <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-4">
                                        <label class="small text-uppercase font-weight-bold text-muted">Operational Status</label>
                                        <div class="d-flex align-items-center justify-content-between p-3 rounded border bg-light">
                                            <div>
                                                <span class="font-weight-bold d-block">Active Status</span>
                                                <small class="text-muted">Is this branch open for business?</small>
                                            </div>
                                            <div class="custom-control custom-switch custom-switch-lg">
                                                <input type="hidden" name="isActive" value="0">
                                                <input type="checkbox" name="isActive" class="custom-control-input" id="branchStatus" value="1" 
                                                       @if(old('isActive', $branch->isActive)) checked @endif>
                                                <label class="custom-control-label" for="branchStatus"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4 opacity-5">

                            <div class="d-flex justify-content-end align-items-center">
                                <a href="{{ route('branches.index') }}" class="btn btn-link text-muted mr-3">Cancel Changes</a>
                                <button type="submit" class="btn btn-warning px-5 py-2 shadow font-weight-bold rounded-pill text-white">
                                    <i class="fas fa-sync-alt mr-2"></i> Update Branch Details
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection