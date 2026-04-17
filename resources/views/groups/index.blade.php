@extends('layout.starter-en')

@section('title', 'Groups')

@section('path', 'Groups')

@section('pageName', 'Groups')

@section('content')

    <div class="container-fluid py-4">
        <div class="card border-0 shadow-sm rounded-lg">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0 font-weight-bold text-primary">Groups Management</h5>
                    <p class="text-muted small mb-0">Overview of all active and upcoming training groups</p>
                </div>
                <a href="{{ route('groups.create') }}" class="btn btn-primary btn-sm px-4 shadow-sm ml-auto">
                    <i class="fas fa-plus mr-1"></i> New Group
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-secondary small text-uppercase font-weight-bold">
                            <tr>
                                <th class="py-3 px-4 border-0">Group Name</th>
                                <th class="py-3 border-0">Program & Session</th>
                                <th class="py-3 border-0">Location</th>
                                <th class="py-3 border-0 text-center">Capacity</th>
                                <th class="py-3 border-0 text-center">Status</th>
                                <th class="py-3 px-4 border-0 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($groups->isEmpty())
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-layer-group fa-2x mb-2"></i>
                                        <div>No groups found. Click "New Group" to create one.</div>
                                    </td>
                                </tr>
                            @endif
                            @foreach($groups as $group)
                            <tr>
                                <td class="px-4 font-weight-bold">{{ $group->name }}</td>
                                
                                <td>
                                    <div class="d-flex flex-column">
                                        <span class="text-dark font-weight-bold">{{ $group->programSession->trainingProgram->name }}</span>
                                        <small class="text-muted">
                                            <i class="far fa-calendar-alt mr-1"></i>
                                            {{ \Carbon\Carbon::parse($group->programSession->start_date)->format('M d') }} - {{ \Carbon\Carbon::parse($group->programSession->end_date)->format('M d, Y') }}
                                        </small>
                                    </div>
                                </td>

                                <td>
                                    @if(is_null($group->branch_id))
                                        <span class="badge bg-soft-info px-3 py-2 rounded-pill">
                                            <i class="fas fa-globe mr-1"></i> Online
                                        </span>
                                    @else
                                        <span class="badge bg-soft-primary px-3 py-2 rounded-pill">
                                            <i class="fas fa-map-marker-alt mr-1"></i> {{ $group->branch->name }}
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-light border px-3 py-1 font-weight-bold">
                                        {{ $group->capacity }} <small class="text-muted font-weight-normal">seats</small>
                                    </span>
                                </td>

                                <td class="text-center">
                                    @if($group->isActive)
                                        <span class="badge bg-soft-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle mr-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-soft-danger px-3 py-2 rounded-pill">
                                            <i class="fas fa-times-circle mr-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 text-right">
                                    <div class="btn-group shadow-sm">
                                        <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-white btn-sm border">
                                            <i class="fas fa-edit text-warning"></i>
                                        </a>
                                        <form action="{{ route('groups.destroy', $group->id) }}" method="POST" class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm border border-left-0" onclick="return confirm('Delete this group?')">
                                                <i class="fas fa-trash text-danger"></i>
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
    </div>

@endsection