@extends('layout.starter-en')

@section('title', 'Edit Student')

@section('path', 'Students / Edit')

@section('pageName', 'Edit Student')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="mb-3">
                <a href="{{ route('students.index') }}" class="text-muted small font-weight-bold text-uppercase">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Students
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h4 class="mb-0 font-weight-bold text-primary">Edit Student: {{ $student->nameEn }}</h4>
                    <p class="text-muted mb-0">Update the profile details, contact information, and status for this student.</p>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger shadow-sm border-0 mb-4">
                            <ul class="mb-0 small font-weight-bold">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-exclamation-triangle mr-1"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('students.update', $student) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Name (English)</label>
                                <input type="text" name="nameEn" class="form-control form-control-lg border-2 @error('nameEn') is-invalid @enderror" 
                                       value="{{ old('nameEn', $student->nameEn) }}" placeholder="Full English Name" required>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted text-right d-block">(الاسم (بالعربية</label>
                                <input type="text" name="nameAr" class="form-control form-control-lg border-2 text-right @error('nameAr') is-invalid @enderror" 
                                       value="{{ old('nameAr', $student->nameAr) }}" placeholder="الاسم الكامل بالعربي" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-envelope text-muted"></i></span>
                                    </div>
                                    <input type="email" name="email" class="form-control border-left-0 @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $student->email) }}" placeholder="example@mail.com" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Phone Number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-phone text-muted"></i></span>
                                    </div>
                                    <input type="text" name="phoneNumber" class="form-control border-left-0 @error('phoneNumber') is-invalid @enderror" 
                                           value="{{ old('phoneNumber', $student->phoneNumber) }}" placeholder="01xxxxxxxxx">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">National ID</label>
                                <input type="text" name="NationalId" class="form-control border-2 @error('NationalId') is-invalid @enderror" 
                                       value="{{ old('NationalId', $student->NationalId) }}" placeholder="14 Digits">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Birth Date</label>
                                <input type="date" name="birthDate" class="form-control border-2 @error('birthDate') is-invalid @enderror" 
                                       value="{{ old('birthDate', $student->birthDate) }}">
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Governorate</label>
                                <select name="governorate" class="form-control custom-select border-2 @error('governorate') is-invalid @enderror">
                                    <option value="" selected disabled>Select Governorate</option>
                                    @foreach(App\Governorate::cases() as $gov)
                                        <option value="{{ $gov->value }}" {{ old('governorate', $student->governorate->value) == $gov->value ? 'selected' : '' }}>
                                            {{ $gov->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <div class="col-md-4 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">School</label>
                                <input type="text" name="school" class="form-control border-2 @error('school') is-invalid @enderror" 
                                       value="{{ old('school', $student->school) }}" placeholder="School Name">
                            </div>

                            <div class="col-md-3 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Status</label>
                                <select name="studentStatus" class="form-control custom-select border-2">
                                    <option value="1" {{ old('studentStatus', $student->studentStatus) == 1 ? 'selected' : '' }}>Graduated</option>
                                    <option value="0" {{ old('studentStatus', $student->studentStatus) == 0 ? 'selected' : '' }}>Undergraduate</option>
                                </select>
                            </div>

                            <div class="col-md-5 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted d-block">Profile Photo</label>
                                <div class="d-flex align-items-center p-2 border rounded bg-light">
                                    <div class="mr-3">
                                        <img src="{{ $student->photoPath ? asset('storage/' . $student->photoPath) : asset('images/default-avatar.png') }}" 
                                             alt="Current Photo" 
                                             class="img-thumbnail rounded-circle" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <input type="file" name="photo" class="form-control-file small">
                                        <small class="text-muted">Leave blank to keep current</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 opacity-5">

                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('students.index') }}" class="btn btn-link text-muted mr-3">Cancel Changes</a>
                            <button type="submit" class="btn btn-warning px-5 py-2 shadow font-weight-bold rounded-pill text-white">
                                <i class="fas fa-sync-alt mr-1"></i> Update Student Record
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection