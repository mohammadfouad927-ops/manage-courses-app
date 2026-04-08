@extends('layout.starter-en')

@section('title','Training Program')

@section('path','Training Program')

@section('pageName','Training Program')

@section('content')
    <div class="container bg-white p-4 shadow-sm rounded">
         @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
      <!-- Header Section -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 text-dark">Training Program List</h3>
        <button type="button" class="btn btn-primary shadow-sm" data-toggle="modal" data-target="#createProgramModal">
            <i class="fas fa-plus"></i> Add New Training Program
        </button>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Courses</th>
              <th>Created At</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($trainingPrograms->isEmpty())
            <tr>
              <td colspan="6" class="text-center py-4 text-muted">No data available in this table</td>
            </tr>
            @else
            @foreach($trainingPrograms as $trainingProgram)
                <tr>
                    <td><span class="text-secondary">#</span>{{$trainingProgram->id}}</td>
                    <td>
                        <div class="fw-bold text-dark">{{$trainingProgram->name}}</div>
                    </td>
                    <td>
                        @foreach($trainingProgram->courses as $course)
                            <span class="badge badge-info bg-light text-dark border">{{$course->name}}</span>
                        @endforeach
                    </td>
                    <td>
                        <small class="text-muted">
                            <i class="far fa-calendar-alt"></i> {{$trainingProgram->created_at->format('d M, Y')}}
                        </small>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-warning mr-1" data-toggle="modal" data-target="#editModal{{$trainingProgram->id}}">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{route('programs.destroy',$trainingProgram)}}" method="post" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this program?');">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @foreach($trainingPrograms as $trainingProgram)
    <div class="modal fade" id="editModal{{$trainingProgram->id}}" tabindex="-1" aria-hidden="true"> 
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('programs.update', $trainingProgram->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Program: {{ $trainingProgram->name }}</h5>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Program Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $trainingProgram->name }}">
                        </div>

                        <h6>Courses</h6>
                        <div id="edit-courses-container-{{$trainingProgram->id}}">
                            @foreach($trainingProgram->courses as $currentCourse)
                            <div class="d-flex mb-2 course-row">
                                <select name="course_ids[]" class="form-control course-select">
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ $course->id == $currentCourse->id ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" class="btn btn-danger btn-sm ms-2 remove-course">×</button>
                            </div>
                            @endforeach
                        </div>
                        
                        <button type="button" class="btn btn-outline-primary btn-sm mt-2 add-edit-course" data-id="{{$trainingProgram->id}}">
                            + Add New Course
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
    <!-- <div class="modal fade" id="editModal{{$trainingProgram->id}}" >
        
    </div> -->
      </div>
    </div>
    <!-- Create Modal -->
    <div class="modal fade" id="createProgramModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('programs.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Training Program</h5>
                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Program Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Select Courses</label>
                            <div id="courses-container">
                            <select class="form-control course-select mb-2" name="course_ids[]">
                                <option value="">-- Choose Course --</option>
                                @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            </div>
                            <button type="button" class="btn btn-sm btn-secondary" id="add-course-btn">+ Add Another Course</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Program</button>
                    </div>
                </form>
            </div>
        </div>
        <script>
                document.getElementById('add-course-btn').addEventListener('click', function() {
                let container = document.getElementById('courses-container');
                let firstSelect = container.querySelector('.course-select');
                let newSelect = firstSelect.cloneNode(true);
                newSelect.value = ""; // تصفير الاختيار الجديد
                
                // الحصول على كل الـ IDs المختارة حالياً
                let selectedIds = Array.from(container.querySelectorAll('.course-select'))
                                    .map(sel => sel.value)
                                    .filter(id => id !== "");

                // إخفاء الخيارات المختارة من الـ Select الجديد
                Array.from(newSelect.options).forEach(option => {
                    if (selectedIds.includes(option.value)) {
                        option.style.display = 'none';
                    } else {
                        option.style.display = 'block';
                    }
                });

                container.appendChild(newSelect);
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
