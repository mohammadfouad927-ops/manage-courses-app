@extends('layout.starter-en')

@push('css')
    <style>
        /* Add a subtle hover effect to rows */
        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.02);
            transition: background-color 0.2s ease;
        }

        /* Soft Badge Colors */
        .bg-soft-success { background-color: rgba(40, 167, 69, 0.1) !important; color: #28a745 !important; }
        .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1) !important; color: #ffc107 !important; }
        .bg-soft-info { background-color: rgba(23, 162, 184, 0.1) !important; color: #17a2b8 !important; }
        .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1) !important; color: #dc3545 !important; border: 1px solid rgba(220, 53, 69, 0.2); /* Optional: adds a thin subtle border */}
        /* Vertical Alignment for clean spacing */
        .align-middle { vertical-align: middle !important; }
    </style>
@endpush

@section('title', 'Program Sessions')

@section('path', 'Program Sessions')

@section('pageName', 'Program Sessions')

@section('content')

<div class="container-fluid py-4">
    @if ($errors->any())
        <div class="alert alert-danger border-0 shadow-sm mb-4">
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle mr-2"></i>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card border-0 shadow-sm rounded-lg">
        <!-- Header Section -->
        <!-- Add 'd-flex align-items-center justify-content-between' to the classes -->
        <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
          <h5 class="mb-0 font-weight-bold text-primary">Program Sessions Management</h5>
    
          <!-- ml-auto (or ms-auto in BS5) pushes this button to the far right -->
          <button type="button" class="btn btn-primary btn-sm px-4 shadow-sm ml-auto" data-toggle="modal" data-target="#createSessionModal">
                <i class="fas fa-plus mr-1"></i> Add New Session
            </button>
      </div>


        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-muted small text-uppercase">
                            <th class="py-3 px-4 border-0">Program Details</th>
                            <th class="py-3 border-0">Investment</th>
                            <th class="py-3 border-0">Timeline</th>
                            <th class="py-3 border-0">Status</th>
                            <th class="py-3 px-4 border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($programSessions as $programSession)
                        <tr>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-primary-soft text-primary rounded-circle mr-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; background-color: rgba(0, 123, 255, 0.1);">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                    <div>
                                        <span class="d-block font-weight-bold text-dark">{{ $programSession->trainingProgram->name }}</span>
                                        <small class="text-muted">ID: #{{ str_pad($programSession->id, 4, '0', STR_PAD_LEFT) }}</small>
                                    </div>
                                </div>
                            </td>

                            <td class="py-3">
                                <span class="text-dark font-weight-bold">{{ number_format($programSession->price, 2) }}</span>
                                <small class="text-muted small">EGP</small>
                            </td>

                            <td class="py-3">
                                <div class="small">
                                    <i class="far fa-calendar-alt text-muted mr-1"></i> 
                                    {{ \Carbon\Carbon::parse($programSession->start_date)->format('M d, Y') }}
                                </div>
                                <div class="small text-muted">
                                    <i class="fas fa-arrow-right mr-1" style="font-size: 10px;"></i>
                                    {{ \Carbon\Carbon::parse($programSession->end_date)->format('M d, Y') }}
                                </div>
                            </td>

                            <td class="py-3">
                                @php
                                    $months = \Carbon\Carbon::parse($programSession->start_date)->diffInMonths(\Carbon\Carbon::parse($programSession->end_date));
                                @endphp
                                <span class="badge rounded-pill px-3 py-2 {{ $programSession->is_active ?  'bg-soft-success text-success' : 'bg-soft-danger text-danger' }}" 
                                    style="font-size: 0.75rem; background-color: rgba(40, 167, 69, 0.1);">
                                    <i class="fas fa-clock mr-1"></i> {{ $months }} Months
                                </span>
                            </td>

                            <td class="py-3 px-4 text-center">
                                <div class="btn-group shadow-sm rounded">
                                    <button type="button" class="btn btn-white btn-sm border" data-toggle="modal" data-target="#editModal{{$programSession->id}}" title="Edit">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <form action="{{route('program-sessions.destroy', $programSession)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-white btn-sm border border-left-0" 
                                                onclick="return confirm('Delete this session?');" title="Delete">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                @foreach($programSessions as $programSession)
                    <div class="modal fade" id="editModal{{ $programSession->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                                <form action="{{ route('program-sessions.update', $programSession) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <div class="modal-header bg-light border-0 py-3">
                                        <h5 class="modal-title font-weight-bold text-warning">
                                            <i class="fas fa-calendar-edit mr-2"></i>Edit Project Session
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body px-4">
                                        <div class="form-group mb-4">
                                            <label class="small text-uppercase font-weight-bold text-muted">Training Program</label>
                                            <select name="training_program_id" class="form-control custom-select border-2" required>
                                                @foreach($trainingPrograms as $program)
                                                    <option value="{{ $program->id }}" {{ $programSession->training_program_id == $program->id ? 'selected' : '' }}>
                                                        {{ $program->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 mb-4">
                                                <label class="small text-uppercase font-weight-bold text-muted">Session Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-white border-right-0 text-success font-weight-bold">$</span>
                                                    </div>
                                                    <input type="number" name="price" class="form-control border-left-0 pl-0" 
                                                        value="{{ $programSession->price }}" step="0.01" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-4">
                                                <label class="small text-uppercase font-weight-bold text-muted">Start Date</label>
                                                <input type="date" name="start_date" class="form-control" value="{{ \Carbon\Carbon::parse($programSession->start_date)->format('Y-m-d') }}" required>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="small text-uppercase font-weight-bold text-muted">End Date</label>
                                                <input type="date" name="end_date" class="form-control" value="{{ \Carbon\Carbon::parse($programSession->end_date)->format('Y-m-d') }}" required>
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between bg-soft-warning p-3 rounded">
                                            <div>
                                                <p class="mb-0 font-weight-bold">Active Status</p>
                                                <small class="opacity-7">Toggle visibility for this session</small>
                                            </div>
                                            <div class="custom-control custom-switch">
                                                <input type="hidden" name="is_active" value="0">
                                                <input type="checkbox" name="is_active" class="custom-control-input" 
                                                    id="editSwitch{{ $programSession->id }}" 
                                                    value="1" {{ $programSession->is_active ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="editSwitch{{ $programSession->id }}"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer border-0 pb-4">
                                        <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-warning px-4 shadow-sm font-weight-bold text-white" style="border-radius: 10px;">
                                            Update Session
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
        <div class="modal fade" id="createSessionModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 shadow-lg" style="border-radius: 15px;">
                    <form action="{{ route('program-sessions.store') }}" method="POST">
                        @csrf
                        
                        <div class="modal-header bg-white border-0 py-3">
                            <h5 class="modal-title font-weight-bold text-primary">
                                <i class="fas fa-calendar-plus mr-2"></i>New Project Session
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body px-4">
                            <div class="form-group mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Training Program</label>
                                <select name="training_program_id" class="form-control custom-select border-2" required>
                                    <option value="" selected disabled>-- Select Program --</option>
                                    @foreach($trainingPrograms as $program)
                                        <option value="{{ $program->id }}">{{ $program->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label class="small text-uppercase font-weight-bold text-muted">Session Price</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-white border-right-0 text-success font-weight-bold">$</span>
                                        </div>
                                        <input type="number" name="price" class="form-control border-left-0 pl-0" placeholder="0.00" step="0.01" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="small text-uppercase font-weight-bold text-muted">Start Date</label>
                                    <input type="date" name="start_date" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="small text-uppercase font-weight-bold text-muted">End Date</label>
                                    <input type="date" name="end_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded">
                                <div>
                                    <p class="mb-0 font-weight-bold text-dark">Active Status</p>
                                    <small class="text-muted">Should this session be visible to users?</small>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="hidden" name="is_active" value="0">
                                    
                                    <input type="checkbox" name="is_active" class="custom-control-input" id="sessionActiveSwitch" value="1" checked>
                                    
                                    <label class="custom-control-label" for="sessionActiveSwitch"></label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 pb-4">
                            <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary px-4 shadow-sm font-weight-bold" style="border-radius: 10px;">
                                Create Session
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

         <!-- Pagination Footer -->
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-end">
                {{ $programSessions->links() }}
            </div>
        </div>
    </div>
</div>



@endsection