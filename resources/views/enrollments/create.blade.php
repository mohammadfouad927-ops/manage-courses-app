@extends('layout.starter-en')

@section('title', 'Create Enrollment')
@section('pageName', 'Create Enrollment')
@section('path', 'Enrollments / Create Enrollment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-3">
                <a href="{{ route('enrollments.index') }}" class="text-muted small font-weight-bold text-uppercase">
                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-lg">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h4 class="mb-0 font-weight-bold text-primary">New Student Enrollment</h4>
                    <p class="text-muted mb-0">Register a student into a specific training session and group.</p>
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

                    <form action="{{ route('enrollments.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Select Student</label>
                                <div class="d-flex align-items-center">
                                    <div class="mr-3">
                                        <img id="student-preview" 
                                            src="{{ asset('storage/avatars/default_photo.jpg') }}" 
                                            class="rounded-circle border shadow-sm" 
                                            style="width: 60px; height: 60px; object-fit: cover;" 
                                            alt="Student Preview">
                                    </div>

                                    <div class="flex-grow-1">
                                        <select id="student-select" name="student_id" class="form-control custom-select border-2 @error('student_id') is-invalid @enderror" required>
                                            <option value="" selected disabled data-photo="{{ asset('storage/avatars/default_photo.jpg') }}">Choose a student...</option>
                                            @foreach($students as $student)
                                                <option value="{{ $student->id }}" 
                                                        data-photo="{{ asset('storage/' . $student->photoPath) }}">
                                                    {{ $student->nameEn }} (ID: {{ $student->id }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @error('student_id') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Program Session</label>
                                <select id="session-select" name="program_session_id" class="form-control custom-select border-2 @error('program_session_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>Select Session...</option>
                                    @foreach($programSessions as $session)
                                        <option value="{{ $session->id }}" data-groups="{{ json_encode($session->groups) }}">
                                            {{ $session->trainingProgram->name }} — {{ $session->start_date }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Available Groups</label>
                                <select id="group-select" name="group_id" class="form-control custom-select border-2 @error('group_id') is-invalid @enderror" disabled required>
                                    <option value="">Choose session first...</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Initial Payment Status</label>
                                <select name="paymentStatus" class="form-control custom-select border-2" required>
                                    @foreach (App\PaymentStatus::cases() as $status)
                                        <option value="{{$status->value}}" @if($status === App\PaymentStatus::Pending) selected @endif>{{$status->label()}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Enrollment Date</label>
                                <input type="date" name="created_at" class="form-control border-2" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <hr class="my-4 opacity-5">

                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('enrollments.index') }}" class="btn btn-link text-muted mr-3">Cancel</a>
                            <button type="submit" class="btn btn-primary px-5 py-2 shadow font-weight-bold rounded-pill">
                                <i class="fas fa-check-circle mr-1"></i> Complete Enrollment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Dynamic Filtering Script --}}
<script>
    document.getElementById('session-select').addEventListener('change', function() {
        const groupSelect = document.getElementById('group-select');
        const selectedOption = this.options[this.selectedIndex];
        
        // Reset and Enable Group Select
        groupSelect.innerHTML = '<option value="" selected disabled>Choose a group...</option>';
        groupSelect.disabled = false;

        if (selectedOption.value) {
            // Get Groups from data attribute
            const groups = JSON.parse(selectedOption.getAttribute('data-groups'));
            
            groups.forEach(group => {
                let option = document.createElement('option');
                option.value = group.id;
                
                // Construct text: "Group A (Sunday, Tuesday)"
                let scheduleText = group.group_schedules && group.group_schedules.length > 0 
                    ? group.group_schedules.map(s => s.day).join(', ') 
                    : 'No schedule';
                
                option.text = `${group.name} (${scheduleText}) ${group.group_schedules[0].start_time} - ${group.group_schedules[0].end_time}`;
                groupSelect.appendChild(option);
            });
        }
    });
        document.getElementById('student-select').addEventListener('change', function() {
        const preview = document.getElementById('student-preview');
        const selectedOption = this.options[this.selectedIndex];
        
        // Get the photo path from the data-photo attribute
        const photoPath = selectedOption.getAttribute('data-photo');
        
        // Update the image src
        preview.src = photoPath;
    });
</script>
@endsection