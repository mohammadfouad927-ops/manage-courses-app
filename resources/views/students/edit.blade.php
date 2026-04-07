@extends('layout.starter-en')

@section('title', 'Add Student')
@section('path', 'Students')
@section('pageName', 'Add Student')

@section('content')
<div class="container bg-white p-4 shadow-sm rounded">
    <div class="mb-4">
        <h3>Create New Student</h3>
        <p class="text-muted">Fill in the profile details for the new student.</p>
    </div>

    <!-- Error Alert -->
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('students.update',$student) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="row">
            <!-- Name English -->
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Name (English)</label>
                <input type="text" name="nameEn" class="form-control @error('nameEn') is-invalid @enderror" value="{{ $student->nameEn }}" placeholder="Full English Name" required>
            </div>

            <!-- Name Arabic -->
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold text-right">الاسم (بالعربية)</label>
                <input type="text" name="nameAr" class="form-control text-right @error('nameAr') is-invalid @enderror" value="{{ $student->nameAr }}" placeholder="الاسم الكامل بالعربي" required>
            </div>
        </div>

        <div class="row">
            <!-- Email -->
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $student->email }}" placeholder="example@mail.com" required>
            </div>

            <!-- Phone Number -->
            <div class="col-md-6 mb-3">
                <label class="form-label font-weight-bold">Phone Number</label>
                <input type="text" name="phoneNumber" class="form-control @error('phoneNumber') is-invalid @enderror" value="{{ $student->phoneNumber }}" placeholder="01xxxxxxxxx">
            </div>
        </div>

        <div class="row">
            <!-- National ID -->
            <div class="col-md-4 mb-3">
                <label class="form-label font-weight-bold">National ID</label>
                <input type="text" name="NationalId" class="form-control @error('NationalId') is-invalid @enderror" value="{{ $student->NationalId }}" placeholder="14 Digits">
            </div>

            <!-- Birth Date -->
            <div class="col-md-4 mb-3">
                <label class="form-label font-weight-bold">Birth Date</label>
                <input type="date" name="birthDate" class="form-control @error('birthDate') is-invalid @enderror" value="{{ $student->birthDate }}">
            </div>

            <!-- Governorate Dropdown -->
            <div class="col-md-4 mb-3">
                <label class="form-label font-weight-bold">Governorate</label>
                <select name="governorate" class="form-control custom-select @error('governorate') is-invalid @enderror">
                    <option value="" selected disabled>Select Governorate</option>
                    @foreach(App\Governorate::cases() as $gov)
                        <option value="{{ $gov->value }}" {{ $student->governorate->value == $gov->value ? 'selected' : '' }}>
                            {{ $gov->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row align-items-center">
            <!-- School -->
            <div class="col-md-5 mb-3">
                <label class="form-label font-weight-bold">School</label>
                <input type="text" name="school" class="form-control @error('school') is-invalid @enderror" value="{{ old('school', $student->school) }}" placeholder="School Name">
            </div>

            <!-- Student Status -->
            <div class="col-md-3 mb-3">
                <label class="form-label font-weight-bold">Status</label>
                <select name="studentStatus" class="form-control custom-select">
                    <option value="1" {{ $student->studentStatus == 1 ? 'selected' : '' }}>Graduated</option>
                    <option value="0" {{ $student->studentStatus == 0 ? 'selected' : '' }}>Under Graduate</option>
                </select>
            </div>

            <!-- Photo Display & Upload -->
            <div class="col-md-4 mb-3">
                <label class="form-label font-weight-bold d-block">Profile Photo</label>
                <div class="d-flex align-items-center">
                    <!-- Current Photo Preview -->
                    <div class="mr-3">
                        <img src="{{ $student->photoPath ? asset('storage/' . $student->photoPath) : asset('images/default-avatar.png') }}" 
                            alt="Current Photo" 
                            class="img-thumbnail" 
                            style="width: 60px; height: 60px; object-fit: cover;">
                    </div>
                    <!-- Upload Input -->
                    <div class="grow">
                        <input type="file" name="photo" class="form-control-file @error('photo') is-invalid @enderror">
                        <small class="text-muted d-block">Leave blank to keep current photo</small>
                    </div>
                </div>
            </div>
        </div>


        <hr class="my-4">

        <div class="d-flex justify-content-end align-items-center">
            <a href="{{ route('students.index') }}" class="btn btn-link text-muted mr-3">Cancel</a>
            <button type="submit" class="btn btn-primary px-5 shadow-sm">
                <i class="fas fa-save mr-1"></i> Save Student Record
            </button>
        </div>
    </form>
</div>
@endsection
