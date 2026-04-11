@extends('layout.starter-en')

@section('title','Training Program')

@section('path','Training Program')

@section('pageName','Training Program')

@push('css')
    <style>

        /* 2. Soft Badge Styling */
        .badge-soft-info {
            background-color: rgba(23, 162, 184, 0.1) !important;
            color: #17a2b8 !important;
            font-weight: 500;
            border-radius: 4px;
        }

        /* 3. Button Group Look */
        .btn-white {
            background-color: #ffffff;
            border-color: #dee2e6;
        }
        .btn-white:hover {
            background-color: #f8f9fa;
        }

        /* 4. Table Alignment */
        .align-middle {
            vertical-align: middle !important;
        }
        
        .gap-1 { gap: 0.25rem; } /* Helpful for spacing out badges */

        /* 5. Modal Refinement */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .modal-header {
            border-bottom: 1px solid #f8f9fa;
        }
        /* 1. Improved Modal Radius */
        .modal-content {
            border-radius: 15px !important;
            overflow: hidden;
        }

        /* 2. Soft Danger Button (for the X) */
        .btn-soft-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: none;
            transition: all 0.2s;
        }
        .btn-soft-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        /* 3. Focus effect for inputs */
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.1);
        }

        /* 4. Align the close button properly in BS4 */
        .modal-header .close {
            padding: 1rem;
            margin: -1rem -1rem -1rem auto;
        }

        /* 5. Custom select arrow fix (prevents ::after bug) */
        .custom-select::after {
            display: none !important;
            content: none !important;
        }
    </style>
@endpush

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
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">Training Program Management</h5>
            <button type="button" class="btn btn-primary btn-sm px-4 shadow-sm ml-auto" data-toggle="modal" data-target="#createProgramModal">
                <i class="fas fa-plus mr-1"></i> Add Program
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-secondary small text-uppercase font-weight-bold">
                            <th class="py-3 px-4 border-0" style="width: 80px;">ID</th>
                            <th class="py-3 border-0">Program Name</th>
                            <th class="py-3 border-0">Included Courses</th>
                            <th class="py-3 border-0">Created</th>
                            <th class="py-3 px-4 border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($trainingPrograms as $trainingProgram)
                        <tr>
                            <td class="px-4 text-muted font-weight-light">#{{ $trainingProgram->id }}</td>
                            <td>
                                <span class="font-weight-bold text-dark">{{ $trainingProgram->name }}</span>
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach($trainingProgram->courses as $course)
                                        <span class="badge badge-soft-info border-0 mr-1 mb-1 px-2 py-1">
                                            {{ $course->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="small text-muted">
                                    <i class="far fa-calendar-alt mr-1"></i> {{ $trainingProgram->created_at->format('d M, Y') }}
                                </div>
                            </td>
                            <td class="px-4 text-center">
                                <div class="btn-group shadow-sm rounded">
                                    <button type="button" class="btn btn-white btn-sm border" data-toggle="modal" data-target="#editModal{{$trainingProgram->id}}" title="Edit">
                                        <i class="fas fa-edit text-warning"></i>
                                    </button>
                                    <form action="{{route('programs.destroy',$trainingProgram)}}" method="post" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-white btn-sm border border-left-0" onclick="return confirm('Delete this program?');" title="Delete">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <img src="{{asset('storage/avatars/no-data.png')}}" style="width: 60px; opacity: 0.3;" class="mb-3">
                                <p>No training programs found.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
    @foreach($trainingPrograms as $trainingProgram)
        <div class="modal fade" id="editModal{{$trainingProgram->id}}" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog modal-dialog-centered" role="document"> <div class="modal-content border-0 shadow-lg">
                    <form action="{{ route('programs.update', $trainingProgram->id) }}" method="POST">
                        @csrf @method('PUT')
                        
                        <div class="modal-header bg-light border-0 py-3">
                            <h5 class="modal-title font-weight-bold text-primary">
                                <i class="fas fa-edit mr-2"></i>Edit Program
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body p-4">
                            <div class="form-group mb-4">
                                <label class="small text-uppercase font-weight-bold text-muted">Program Name</label>
                                <input type="text" name="name" class="form-control form-control-lg border-2" 
                                    value="{{ $trainingProgram->name }}" style="font-size: 1rem;">
                            </div>

                            <hr class="my-4">

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="mb-0 font-weight-bold"><i class="fas fa-book-open mr-2 text-info"></i>Included Courses</h6>
                            </div>

                            <div id="edit-courses-container-{{$trainingProgram->id}}">
                                @foreach($trainingProgram->courses as $currentCourse)
                                <div class="d-flex mb-3 course-row align-items-center">
                                    <div class="flex-grow-1">
                                        <select name="course_ids[]" class="form-control custom-select course-select">
                                            @foreach($courses as $course)
                                                <option value="{{ $course->id }}" {{ $course->id == $currentCourse->id ? 'selected' : '' }}>
                                                    {{ $course->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ml-2">
                                        <button type="button" class="btn btn-soft-danger btn-sm remove-course" style="border-radius: 8px;">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            <button type="button" class="btn btn-outline-info btn-sm btn-block mt-2 add-edit-course" 
                                    data-id="{{$trainingProgram->id}}" style="border-style: dashed; border-width: 2px;">
                                <i class="fas fa-plus-circle mr-1"></i> Add Another Course
                            </button>
                        </div>

                        <div class="modal-footer bg-light border-0">
                            <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success px-4 shadow-sm font-weight-bold">
                                <i class="fas fa-save mr-1"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
    
      </div>
    </div>
    <!-- Create Modal -->
    <div class="modal fade" id="createProgramModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content border-0 shadow-lg">
            <form action="{{ route('programs.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-light border-0 py-3">
                    <h5 class="modal-title font-weight-bold text-primary">
                        <i class="fas fa-plus-circle mr-2"></i>Add New Training Program
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body p-4">
                    <div class="form-group mb-4">
                        <label class="small text-uppercase font-weight-bold text-muted">Program Name</label>
                        <input type="text" name="name" class="form-control form-control-lg border-2" 
                               placeholder="e.g. Advanced Web Development" required>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="mb-0 font-weight-bold">
                            <i class="fas fa-list-ul mr-2 text-info"></i>Select Courses
                        </h6>
                    </div>

                    <div id="courses-container">
                        <div class="d-flex mb-3 course-row align-items-center">
                            <div class="flex-grow-1">
                                <select class="form-control custom-select course-select" name="course_ids[]" required>
                                    <option value="" selected disabled>-- Choose Course --</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="ml-2" style="width: 32px;"></div> 
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-info btn-sm btn-block mt-2" id="add-course-btn" 
                            style="border-style: dashed; border-width: 2px; border-radius: 8px;">
                        <i class="fas fa-plus mr-1"></i> Add Another Course
                    </button>
                </div>

                <div class="modal-footer bg-light border-0">
                    <button type="button" class="btn btn-link text-muted font-weight-bold" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 shadow-sm font-weight-bold">
                        <i class="fas fa-check mr-1"></i> Save Program
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
        <script>
               document.getElementById('add-course-btn').addEventListener('click', function() {
                    let container = document.getElementById('courses-container');
                    
                    // 1. Get all currently selected IDs to hide them in the new dropdown
                    let selectedIds = Array.from(container.querySelectorAll('.course-select'))
                                        .map(sel => sel.value)
                                        .filter(id => id !== "");

                    // 2. Clone the very first row to keep the styling consistent
                    let firstRow = container.querySelector('.course-row');
                    let newRow = firstRow.cloneNode(true);
                    
                    // 3. Setup the new Select inside the cloned row
                    let newSelect = newRow.querySelector('.course-select');
                    newSelect.value = ""; // Reset selection
                    
                    // 4. Filter options (Your original logic)
                    Array.from(newSelect.options).forEach(option => {
                        if (selectedIds.includes(option.value)) {
                            option.style.display = 'none';
                        } else {
                            option.style.display = 'block';
                        }
                    });

                    // 5. Add the "Remove" button to the new row (making it nice)
                    // We target the placeholder div we left in the HTML
                    let actionContainer = newRow.querySelector('.ml-2');
                    actionContainer.style.width = "auto"; // Remove the fixed width placeholder
                    actionContainer.innerHTML = `
                        <button type="button" class="btn btn-soft-danger btn-sm remove-new-course" style="border-radius: 8px;">
                            <i class="fas fa-times"></i>
                        </button>
                    `;

                    // 6. Append the finished row to the container
                    container.appendChild(newRow);
                });

                // 7. Event Delegation to handle the "Remove" clicks for newly added rows
                document.addEventListener('click', function(e) {
                    if (e.target.closest('.remove-new-course')) {
                        e.target.closest('.course-row').remove();
                    }
                });
        </script>
        @push('scripts')
        <script>
            $(document).ready(function() {
                // Remove course row logic
                $(document).on('click', '.remove-course', function(e) {
                    e.preventDefault();
                    
                    let modalBody = $(this).closest('.modal-body');
                    let container = $(this).closest('[id^="edit-courses-container-"]');
                    let rows = container.find('.course-row');

                    // Prevent removing if it's the last row remaining
                    if (rows.length > 1) {
                        $(this).closest('.course-row').remove();
                        
                        // After removing, refresh the dropdown options and "Add" button visibility
                        updateSelectedOptions(modalBody);
                    } else {
                        alert("At least one course is required.");
                    }
                });

                $(document).on('click', '.add-edit-course', function(e) {
                e.preventDefault();
                let programId = $(this).data('id');
                let container = $('#edit-courses-container-' + programId);
                let firstRow = container.find('.course-row').first();
                
                // Clone the row
                let newRow = firstRow.clone();
                
                // IMPORTANT: Clear the value and ensure the name attribute exists
                let newSelect = newRow.find('select');
                newSelect.val(''); 
                newSelect.attr('name', 'course_ids[]'); // Force ensure the name is there
                
                // Append to container
                container.append(newRow);

                updateSelectedOptions(container.closest('.modal-body')); 
            });


                function updateSelectedOptions(modalBody) {
                    let selects = modalBody.find('.course-select');
                    let selectedValues = [];

                    // Collect what is currently selected
                    selects.each(function() {
                        if ($(this).val()) selectedValues.push($(this).val());
                    });

                    // Hide/Show options inside the dropdowns
                    selects.each(function() {
                        let currentSelect = $(this);
                        let currentVal = currentSelect.val();
                        
                        currentSelect.find('option').each(function() {
                            let optVal = $(this).val();
                            if (optVal !== "") { 
                                if (selectedValues.includes(optVal) && optVal !== currentVal) {
                                    $(this).hide();
                                } else {
                                    $(this).show();
                                }
                            }
                        });
                    });

                    // --- THE FIX: COUNT AND HIDE ---
                    // Get total courses available in the database (excluding placeholder)
                    let totalAvailableCourses = selects.first().find('option').filter(function() {
                        return $(this).val() !== ""; 
                    }).length;

                    let addBtn = modalBody.find('.add-edit-course');

                    // If the number of rows is equal to or more than available courses, hide button
                    if (selects.length >= totalAvailableCourses) {
                        addBtn.hide();
                    } else {
                        addBtn.show();
                    }
                }

                // Ensure the logic runs when a value is changed manually
                $(document).on('change', '.course-select', function() {
                    let modalBody = $(this).closest('.modal-body');
                    updateSelectedOptions(modalBody);
                });
            });
            



        </script>
        @endpush
    </div>


@endsection
