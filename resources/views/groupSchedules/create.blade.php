@extends('layout.starter-en')

@section('title', 'Add Schedule')
@section('path', 'Schedules / Create')
@section('pageName', 'Add Schedule')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-3">
                <a href="{{ route('groupSchedules.index') }}" class="text-muted small font-weight-bold text-uppercase">
                    <i class="fas fa-arrow-left mr-1"></i> Back to Schedules
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h4 class="mb-0 font-weight-bold text-primary">Create New Time Slot</h4>
                    <p class="text-muted mb-0">Assign a day and time to a specific group session.</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('groupSchedules.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-4">
                            <label class="small text-uppercase font-weight-bold text-muted">Select Group Session</label>
                            <select name="group_id" class="form-control custom-select border-2 @error('group_id') is-invalid @enderror" required>
                                <option value="" selected disabled>Choose the group and training program...</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                        {{ $group->name }} — {{ $group->programSession->trainingProgram->name }} (Starts: {{ $group->programSession->start_date }})
                                    </option>
                                @endforeach
                            </select>
                            @error('group_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Day</label>
                                <select name="day" class="form-control custom-select border-2 @error('day') is-invalid @enderror" required>
                                    <option value="" selected disabled>Select Day</option>
                                    @foreach(App\DaysWeek::cases() as $day)
                                        <option value="{{ $day->value }}" {{ old('day') == $day->value ? 'selected' : '' }}>
                                            {{ $day->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Start Time</label>
                                <input type="time" name="start_time" value="{{ old('start_time') }}" 
                                       class="form-control border-2 @error('start_time') is-invalid @enderror" required>
                            </div>

                            <div class="col-md-4 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">End Time</label>
                                <input type="time" name="end_time" value="{{ old('end_time') }}" 
                                       class="form-control border-2 @error('end_time') is-invalid @enderror" required>
                            </div>
                        </div>

                        <hr class="my-4 opacity-5">

                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('groupSchedules.index') }}" class="btn btn-link text-muted mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5 py-2 shadow font-weight-bold rounded-pill">
                                <i class="fas fa-calendar-plus mr-1"></i> Save Schedule
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection