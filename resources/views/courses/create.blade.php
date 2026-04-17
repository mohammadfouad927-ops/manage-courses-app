@extends('layout.starter-en')

@section('title', 'Add Course')

@section('path', 'Courses / Create')

@section('pageName', 'Add Course')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-3">
                <a href="{{ route('courses.index') }}" class="text-muted small font-weight-bold text-uppercase">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Courses
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h4 class="mb-0 font-weight-bold text-primary">Create New Course</h4>
                    <p class="text-muted mb-0">Enter the details below to add a new course to the system.</p>
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

                    <form action="{{ route('courses.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label for="name" class="small text-uppercase font-weight-bold text-muted">Course Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-book text-muted"></i></span>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name') }}" id="name" 
                                           class="form-control border-left-0 border-2 @error('name') is-invalid @enderror" 
                                           placeholder="e.g. Computer Science" required>
                                </div>
                                @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label for="code" class="small text-uppercase font-weight-bold text-muted">Course Code</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-light border-right-0"><i class="fas fa-hashtag text-muted"></i></span>
                                    </div>
                                    <input type="text" name="code" value="{{ old('code') }}" id="code" 
                                           class="form-control border-left-0 border-2 @error('code') is-invalid @enderror" 
                                           placeholder="e.g. CS101" required>
                                </div>
                                @error('code')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Course Visibility</label>
                                <div class="d-flex align-items-center justify-content-between p-3 rounded border bg-light">
                                    <div>
                                        <span class="font-weight-bold d-block">Active Status</span>
                                        <small class="text-muted">Should this course be visible immediately?</small>
                                    </div>
                                    <div class="custom-control custom-switch custom-switch-lg">
                                        <input type="hidden" name="active" value="0">
                                        <input type="checkbox" name="active" class="custom-control-input" id="courseActive" value="1" {{ old('active', '1') == '1' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="courseActive"></label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4 opacity-5">

                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('courses.index') }}" class="btn btn-link text-muted mr-3">Discard</a>
                            <button type="submit" class="btn btn-primary px-5 py-2 shadow font-weight-bold rounded-pill">
                                <i class="fas fa-plus-circle mr-1"></i> Create Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection