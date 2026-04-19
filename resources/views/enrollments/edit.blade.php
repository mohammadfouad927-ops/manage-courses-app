@extends('layout.starter-en')

@section('title', 'Edit Enrollment')
@section('pageName', 'Edit Enrollment')
@section('path', 'Enrollments / Edit')

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
                    <h4 class="mb-0 font-weight-bold text-primary">Edit Enrollment</h4>
                    <p class="text-muted mb-0">Update details for the selected registration.</p>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('enrollments.update', $enrollment) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-md-12 mb-4 bg-light p-3 rounded-lg border">
                            <label class="small text-uppercase font-weight-bold text-muted d-block">Student Information</label>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('storage/' . $enrollment->student->photoPath) }}" 
                                     class="rounded-circle border shadow-sm mr-3" 
                                     style="width: 70px; height: 70px; object-fit: cover;">
                                <div>
                                    <h5 class="mb-0 font-weight-bold text-dark">{{ $enrollment->student->nameEn }}</h5>
                                    <p class="mb-0 text-muted small text-uppercase">Student ID: #{{ $enrollment->student_id }}</p>
                                </div>
                                <input type="hidden" name="student_id" value="{{ $enrollment->student_id }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Program Session</label>
                                <select id="session-select" name="program_session_id" class="form-control custom-select border-2" required>
                                    @foreach($programSessions as $session)
                                        <option value="{{ $session->id }}" 
                                            {{ $enrollment->group->program_session_id == $session->id ? 'selected' : '' }}
                                            data-groups="{{ json_encode($session->groups) }}">
                                            {{ $session->trainingProgram->name }} ({{ $session->start_date }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Group</label>
                                <select id="group-select" name="group_id" class="form-control custom-select border-2" required>
                                    @foreach($enrollment->group->programSession->groups as $group)
                                        <option value="{{ $group->id }}" {{ $enrollment->group_id == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }} ({{$group->groupSchedules[0]->day}}, {{$group->groupSchedules[1]->day}})
                                            {{$group->groupSchedules[0]->start_time->format('g:i A')}} - {{$group->groupSchedules[0]->end_time->format('g:i A')}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Payment Status</label>
                                <select name="paymentStatus" class="form-control custom-select border-2" required>
                                    @foreach(App\PaymentStatus::cases() as $status)
                                        <option value="{{ $status->value }}" {{ $enrollment->paymentStatus == $status ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="my-4 opacity-5">

                        <div class="d-flex justify-content-end align-items-center">
                            <a href="{{ route('enrollments.index') }}" class="btn btn-link text-muted mr-3">Cancel</a>
                            <button type="submit" class="btn btn-warning px-5 py-2 shadow font-weight-bold rounded-pill text-white">
                                <i class="fas fa-sync-alt mr-1"></i> Update Enrollment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('session-select').addEventListener('change', function() {
        const groupSelect = document.getElementById('group-select');
        const selectedOption = this.options[this.selectedIndex];
        
        groupSelect.innerHTML = '<option value="" selected disabled>Choose a group...</option>';

        if (selectedOption.value) {
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
</script>
@endsection