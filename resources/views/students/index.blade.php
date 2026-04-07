@extends('layout.starter-en')

@section('title','Students')

@section('path','Students')

@section('pageName','Students')


@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-lg">
        <!-- Header Section -->
        <!-- Add 'd-flex align-items-center justify-content-between' to the classes -->
        <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
          <h5 class="mb-0 font-weight-bold text-primary">Student Management</h5>
    
          <!-- ml-auto (or ms-auto in BS5) pushes this button to the far right -->
          <a href="{{route('students.create')}}" class="btn btn-primary btn-sm px-3 shadow-sm ml-auto">
              <i class="fas fa-plus mr-1"></i> Add New Student
          </a>
      </div>


        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light">
                        <tr class="text-secondary text-uppercase small font-weight-bold">
                            <th class="px-4 py-3">Student</th>
                            <th class="py-3">Email</th>
                            <th class="py-3">School</th>
                            <th class="py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                        <tr onclick="">
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <!-- Circular Avatar -->
                                    <img src="{{ asset('storage/'.$student->photoPath) }}" 
                                         class="rounded-circle mr-3 border" 
                                         style="width: 40px; height: 40px; object-fit: cover;" 
                                         alt="Student Photo">
                                    <div>
                                        <a href="{{route('students.show',$student)}}" class="text-decoration-none font-weight-bold">{{ $student->nameEn }}</a><br>
                                        <small class="text-muted">ID: #{{ $student->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-muted">{{ $student->email }}</td>
                            <td>
                                <span class="badge badge-soft-info px-2 py-1">{{ $student->school }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{route('students.edit', $student)}}" class="btn btn-outline-warning btn-sm border-0" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{route('students.destroy', $student)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm border-0" 
                                                onclick="return confirm('Delete student? This cannot be undone.');" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <img src="/images/no-data.svg" alt="No Data" style="width: 150px;" class="mb-3 opacity-50">
                                <p class="text-muted">No students found in the database.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
         <!-- Pagination Footer -->
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-end">
                {{ $students->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
