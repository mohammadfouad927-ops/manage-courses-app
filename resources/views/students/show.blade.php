@extends('layout.starter-en')

@section('title', 'Student Profile')
@section('path', 'Students / View')
@section('pageName', 'Student Profile')

@section('content')
<div class="container py-4">
    <!-- Back Button & Actions -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('students.index') }}" class="btn btn-outline-secondary shadow-sm">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
        <div class="btn-group">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-warning shadow-sm">
                <i class="fas fa-edit"></i> Edit Profile
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar: Photo and Status -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm text-center p-4">
                <div class="mb-3">
                    <img src="{{ $student->photoPath ? asset('storage/' . $student->photoPath) : asset('images/default-avatar.png') }}" 
                         class="rounded-circle img-thumbnail shadow-sm" 
                         style="width: 150px; height: 150px; object-fit: cover;" 
                         alt="Student Photo">
                </div>
                <h4 class="font-weight-bold mb-1">{{ $student->nameEn }}</h4>
                <p class="text-muted">{{ $student->nameAr }}</p>
                <span class="badge {{ $student->studentStatus ? 'badge-success' : 'badge-danger' }} px-3 py-2">
                    @if($student->studentStatus) Graduated @else Under Graduated @endif
                </span>
                <hr>
                <div class="text-left small">
                    <p class="mb-1 text-muted">Student ID</p>
                    <p class="font-weight-bold">#{{ $student->id }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content: Detailed Information -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h5 class="font-weight-bold text-primary mb-0">Personal Information</h5>
                </div>
                <div class="card-body px-4">
                    <div class="row">
                        <!-- Contact Info -->
                        <div class="col-sm-6 mb-4">
                            <label class="text-muted small text-uppercase">Email Address</label>
                            <p class="font-weight-bold">{{ $student->email }}</p>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label class="text-muted small text-uppercase">Phone Number</label>
                            <p class="font-weight-bold">{{ $student->phoneNumber ?? 'N/A' }}</p>
                        </div>

                        <!-- Identification -->
                        <div class="col-sm-6 mb-4">
                            <label class="text-muted small text-uppercase">National ID</label>
                            <p class="font-weight-bold">{{ $student->NationalId ?? 'Not Provided' }}</p>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label class="text-muted small text-uppercase">Birth Date</label>
                            <p class="font-weight-bold">{{ $student->birthDate ? \Carbon\Carbon::parse($student->birthDate)->format('d M, Y') : 'N/A' }}</p>
                        </div>

                        <!-- Geography & School -->
                        <div class="col-sm-6 mb-4">
                            <label class="text-muted small text-uppercase">Governorate</label>
                            <p class="font-weight-bold">{{ $student->governorate }}</p>
                        </div>
                        <div class="col-sm-6 mb-4">
                            <label class="text-muted small text-uppercase">School / Institute</label>
                            <p class="font-weight-bold">{{ $student->school }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
