@extends('layout.starter-en')

@section('title', 'Group Schedules')
@section('path', 'Schedules')
@section('pageName', 'Group Schedules')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-lg">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">Weekly Time Slots</h5>
            <a href="{{ route('groupSchedules.create') }}" class="btn btn-primary rounded-pill px-4 ml-auto shadow-sm">
                <i class="fas fa-plus mr-1"></i> Add Schedule
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-items-center mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 text-uppercase text-muted small font-weight-bold">#</th> <th class="text-uppercase text-muted small font-weight-bold">Session Info</th> 
                        <th class="text-uppercase text-muted small font-weight-bold">Day</th>
                        <th class="text-uppercase text-muted small font-weight-bold">Time Window</th>
                        <th class="text-center text-uppercase text-muted small font-weight-bold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($groupSchedules as $schedule)
                    <tr>
                        <td class="px-4">
                            <span class="text-secondary small font-weight-bold">{{ $schedule->id }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-soft-primary text-primary mr-3 rounded-circle p-2" style="background: #eef2ff; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-chalkboard-teacher fa-sm"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 font-weight-bold text-dark text-sm">{{ $schedule->group->name }}</h6>
                                    <small class="text-primary font-weight-bold text-uppercase" style="font-size: 0.7rem;">
                                        {{ $schedule->group->programSession->trainingProgram->name ?? 'No Course' }}<br>
                                         Starts: {{ $schedule->group->programSession->start_date ?? 'N/A' }}
                                    </small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge border text-dark px-3 py-2 rounded-pill bg-white font-weight-normal">
                                <i class="far fa-calendar-alt mr-1 text-primary"></i> {{ $schedule->day }}
                            </span>
                        </td>
                        <td>
                            <div class="small font-weight-bold text-dark">
                                {{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }} 
                                <span class="text-muted mx-1">→</span>
                                {{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm rounded-pill overflow-hidden" style="border: 1px solid #eee;">        
                                <a href="{{ route('groupSchedules.edit', $schedule) }}" 
                                   class="btn btn-white btn-sm text-warning border-0" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('groupSchedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this schedule?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-white btn-sm text-danger border-0" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="{{ asset('images/empty-schedule.svg') }}" style="width: 150px; opacity: 0.5;" alt="No Data">
                                <p class="text-muted mt-3">No schedules found for any groups yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(method_exists($groupSchedules, 'links'))
        <div class="card-footer bg-white border-0">
            {{ $groupSchedules->links() }}
        </div>
        @endif
    </div>
</div>
@endsection