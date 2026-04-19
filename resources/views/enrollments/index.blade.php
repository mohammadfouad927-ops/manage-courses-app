@extends('layout.starter-en')

@section('title', 'Enrollments')
@section('path', 'Enrollments')
@section('pageName', 'Enrollment Management')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-lg">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">Enrollment List</h5>
            <a href="{{ route('enrollments.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm ml-auto">
                <i class="fas fa-plus mr-1"></i> New Enrollment
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-items-center mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 text-muted small font-weight-bold">#</th>
                        <th class="text-muted small font-weight-bold">Student</th>
                        <th class="text-muted small font-weight-bold">Session Details</th>
                        <th class="text-muted small font-weight-bold">Group & Timing</th>
                        <th class="text-muted small font-weight-bold">Payment</th>
                        <th class="text-muted small font-weight-bold">Date Joined</th>
                        <th class="text-center text-muted small font-weight-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($enrollments->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <img src="{{ asset('storage/avatars/no-data.png') }}" style="width: 150px; opacity: 0.5;" alt="No Data">
                                <p class="text-muted mt-3">No schedules found for any groups yet.</p>
                            </td>
                        </tr>
                    @endif
                    @foreach($enrollments as $enrollment)
                    <tr>
                        <td class="px-4 text-secondary small font-weight-bold">{{ $enrollment->id }}</td>
                        
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-primary text-primary mr-3 rounded-circle d-flex align-items-center justify-content-center" style="width:35px; height:35px; background: #eef2ff;">
                                    <i class="fas fa-user-graduate"></i>
                                </div>
                                <span class="font-weight-bold text-dark">{{ $enrollment->student->nameEn }}</span>
                            </div>
                        </td>

                        <td>
                            <div class="d-flex flex-column">
                                <span class="text-dark font-weight-bold small">{{ $enrollment->programSession->trainingProgram->name }}</span>
                                <small class="text-muted">
                                    <i class="far fa-calendar-check mr-1"></i> Starts: {{ $enrollment->programSession->start_date }}
                                </small>
                                <small class="text-muted">
                                    <i class="far fa-hourglass mr-1"></i> {{ \Carbon\Carbon::parse($enrollment->programSession->end_date)->diffForHumans(\Carbon\Carbon::parse($enrollment->programSession->start_date)) }}
                                </small>
                            </div>
                        </td>

                        <td>
    <div class="d-flex flex-column">
        @if($enrollment->group->branch_id == null)
            <span class="badge badge-pill border border-info text-info bg-white align-self-start mb-2 px-2 shadow-sm">
                <i class="fas fa-video mr-1"></i> Online Session
            </span>
        @else
            <span class="badge badge-pill border border-dark text-dark bg-white align-self-start mb-2 px-2 shadow-sm">
                <i class="fas fa-building mr-1"></i> {{ $enrollment->group->branch->name }}
            </span>
        @endif
        
        <div class="mb-1">
            <span class="text-dark font-weight-bold mr-1">{{ $enrollment->group->name }}</span><br>
            @forelse($enrollment->group->groupSchedules as $schedule)
                <span class="badge badge-soft-primary text-primary border-0 px-2 py-0" style="background: #eef2ff; font-size: 0.7rem;">
                    {{ $schedule->day->label() }}
                </span>
            @empty
                <small class="text-muted italic">TBD</small>
            @endforelse
        </div>

        @if($enrollment->group->groupSchedules->isNotEmpty())
            <small class="text-muted font-weight-bold">
                <i class="far fa-clock mr-1 text-primary"></i>
                {{ \Carbon\Carbon::parse($enrollment->group->groupSchedules->first()->start_time)->format('h:i A') }} 
                <span class="mx-1">→</span>
                {{ \Carbon\Carbon::parse($enrollment->group->groupSchedules->first()->end_time)->format('h:i A') }}
            </small>
        @endif
    </div>
</td>

                        <td>
                            <span class="badge {{ $enrollment->paymentStatus->class() }} px-3 py-1 rounded-pill shadow-xs small">
                                {{ $enrollment->paymentStatus->label() }}
                            </span>
                        </td>

                        <td>
                            <div class="small">
                                <span class="text-dark d-block">{{ $enrollment->created_at->format('M d, Y') }}</span>
                                <span class="text-muted text-xs">{{ $enrollment->created_at->format('h:i A') }}</span>
                            </div>
                        </td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('enrollments.edit', $enrollment) }}" class="btn btn-sm btn-outline-warning rounded-circle mr-2" style="width:32px; height:32px;">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                
                                <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this row?')">
                                    @csrf
                                    @method('DELETE')
                                     <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" style="width:32px; height:32px;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection