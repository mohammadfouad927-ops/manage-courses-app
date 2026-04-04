@extends('layout.starter-en')

@section('title','Add Course')

@section('path','course')

@section('pageName','Add Course')

@section('content')
<div class="container bg-white p-4 shadow-sm rounded">
    <div class="mb-4">
        <h3>Create New Course</h3>
        <p class="text-muted">Enter the details below to add a new course to the system.</p>
    </div>

     @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Course Name -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label font-weight-bold">Course Name</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Computer Science" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Course Code -->
            <div class="col-md-6 mb-3">
                <label for="code" class="form-label font-weight-bold">Course Code</label>
                <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" placeholder="e.g. CS101" required>
                @error('code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Status Dropdown -->
            <div class="col-md-6 mb-3">
                <label for="active" class="form-label font-weight-bold">Status</label>
                <select name="active" id="active" class="form-control custom-select">
                    <option value="1" selected>Activated</option>
                    <option value="0">Not Activated</option>
                </select>
                <small class="form-text text-muted">Active courses are visible to students.</small>
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('courses.index') }}" class="btn btn-secondary mr-2">Cancel</a>
            <button type="submit" class="btn btn-primary px-4">Save Course</button>
        </div>
    </form>
</div>

@endsection