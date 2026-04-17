@extends('layout.starter-en')

@section('title', 'Create Group')

@section('path', 'Groups / Create')

@section('pageName', 'Create Group')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="mb-3">
                    <a href="{{ route('groups.index') }}" class="text-muted small font-weight-bold">
                        <i class="fas fa-chevron-left mr-1"></i> Back to Groups
                    </a>
                </div>

                <div class="card border-0 shadow-sm rounded-lg">
                    <div class="card-header bg-white border-0 py-4 px-4">
                        <h4 class="mb-0 font-weight-bold text-primary">Create New Group</h4>
                        <p class="text-muted small">Group students into sessions and assign locations.</p>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('groups.store') }}" method="POST">
                            @csrf

                            <div class="form-group mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Group Name</label>
                                <input type="text" name="name" class="form-control form-control-lg border-2 @error('name') is-invalid @enderror" 
                                    placeholder="e.g. Morning Batch - A" value="{{ old('name') }}" required>
                                @error('name') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Assign to Session</label>
                                <select name="program_session_id" class="form-control custom-select border-2 @error('program_session_id') is-invalid @enderror" required>
                                    <option value="" selected disabled>-- Select Program Session --</option>
                                    @foreach($programSessions as $session)
                                        <option value="{{ $session->id }}" {{ old('program_session_id') == $session->id ? 'selected' : '' }}>
                                            {{ $session->trainingProgram->name }} ({{ \Carbon\Carbon::parse($session->start_date)->format('M d, Y') }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('program_session_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="small text-uppercase font-weight-bold text-muted">Group capacity</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light border-right-0"><i class="fas fa-users text-muted"></i></span>
                                        </div>
                                        <input type="number" name="capacity" class="form-control border-left-0 @error('capacity') is-invalid @enderror" placeholder="e.g. 20" value="{{ old('capacity') }}" required>
                                        @error('capacity') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="small text-uppercase font-weight-bold text-muted">Visibility Status</label>
                                    <div class="d-flex align-items-center justify-content-between p-2 rounded border bg-light">
                                        <span class="small ml-2">Active?</span>
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="isActive" value="0">
                                            <input type="checkbox" name="isActive" class="custom-control-input" id="groupActive" value="1" checked>
                                            <label class="custom-control-label" for="groupActive"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- <div class="form-group mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted d-block">Location Type</label>
                                <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                    <label class="btn btn-outline-info py-2 active flex-fill">
                                        <input type="radio" name="location_type" id="option_online" value="online" checked> 
                                        <i class="fas fa-globe mr-1"></i> Online Session
                                    </label>
                                    <label class="btn btn-outline-info py-2 flex-fill">
                                        <input type="radio" name="location_type" id="option_branch" value="branch"> 
                                        <i class="fas fa-building mr-1"></i> At Branch
                                    </label>
                                </div>
                            </div>

                            <div id="branch_selection_container" class="form-group mb-4 animated fadeIn" style="display: none;">
                                <label class="small text-uppercase font-weight-bold text-muted">Select Branch</label>
                                <select name="branch_id" id="branch_id_select" class="form-control border-2 @error('branch_id') is-invalid @enderror">
                                    <option value="" selected disabled>-- Choose Branch Location --</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                                @error('branch_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div> -->

                            
                            <div class="form-group mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted d-block">Location Type</label>
                                
                                <input type="hidden" name="location_type" id="location_type_input" value="online">

                                <div class="d-flex">
                                    <button type="button" id="btn_online" class="btn btn-info py-2 flex-fill mr-2 shadow-sm rounded-pill font-weight-bold">
                                        <i class="fas fa-globe mr-1"></i> Online Session
                                    </button>
                                    <button type="button" id="btn_branch" class="btn btn-outline-info py-2 flex-fill shadow-sm rounded-pill font-weight-bold">
                                        <i class="fas fa-building mr-1"></i> At Branch
                                    </button>
                                </div>
                            </div>

                            <div id="branch_selection_container" class="form-group mb-4" style="display: none;">
                                <label class="small text-uppercase font-weight-bold text-muted">Select Branch</label>
                                <select name="branch_id" id="branch_id_select" class="form-control border-2 @error('branch_id') is-invalid @enderror">
                                    <option value="" selected disabled>-- Choose Branch Location --</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('branch_id') <span class="invalid-feedback d-block">{{ $message }}</span> @enderror
                            </div>
                            <div class="mt-5">
                                <button type="submit" class="btn btn-primary btn-block btn-lg shadow rounded-pill font-weight-bold">
                                    Create Training Group
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script>
        document.querySelectorAll('input[name="location_type"]').forEach((radio) => {
            radio.addEventListener('change', function() {
                const branchContainer = document.getElementById('branch_selection_container');
                const branchSelect = document.getElementById('branch_id_select');
                console.log('Location type changed to:', this.value);
                if (this.value === 'branch') {
                    branchContainer.style.display = 'block';
                    branchSelect.setAttribute('required', 'required');
                } else {
                    branchContainer.style.display = 'none';
                    branchSelect.removeAttribute('required');
                    branchSelect.value = ''; // Ensure branch_id is null on server
                }
            });
        });
    </script> -->

    <script>
        const btnOnline = document.getElementById('btn_online');
        const btnBranch = document.getElementById('btn_branch');
        const locationInput = document.getElementById('location_type_input');
        const branchContainer = document.getElementById('branch_selection_container');
        const branchSelect = document.getElementById('branch_id_select');

        function setLocation(type) {
            if (type === 'online') {
                // Update UI
                btnOnline.classList.replace('btn-outline-info', 'btn-info');
                btnBranch.classList.replace('btn-info', 'btn-outline-info');
                
                // Hide/Reset Branch
                branchContainer.style.display = 'none';
                branchSelect.removeAttribute('required');
                branchSelect.value = '';
                
                // Set Input Value
                locationInput.value = 'online';
            } else {
                // Update UI
                btnBranch.classList.replace('btn-outline-info', 'btn-info');
                btnOnline.classList.replace('btn-info', 'btn-outline-info');
                
                // Show/Require Branch
                branchContainer.style.display = 'block';
                branchSelect.setAttribute('required', 'required');
                
                // Set Input Value
                locationInput.value = 'branch';
            }
        }

        btnOnline.addEventListener('click', () => setLocation('online'));
        btnBranch.addEventListener('click', () => setLocation('branch'));

        document.addEventListener('DOMContentLoaded', function(){
            const existingBranch = "{{ old('branch_id') }}";
            if(existingBranch && existingBranch !== ""){
                setLocation('branch');
            } else{
                setLocation('online');
            }
        })
    </script>
@endsection