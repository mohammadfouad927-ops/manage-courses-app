@extends('layout/starter-en')

@section('title','Courses')

@section('path','Courses')

@section('pageName','Courses')

@section('content')
<div class="container-fluid py-4">
    <div class="card border-0 shadow-sm rounded-lg">
        <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 font-weight-bold text-primary">Course Catalog</h5>
            <a href="{{route('courses.create')}}" class="btn btn-primary btn-sm px-4 shadow-sm ml-auto">
                <i class="fas fa-plus mr-1"></i> Add New Course
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-secondary small text-uppercase font-weight-bold">
                            <th class="py-3 px-4 border-0">Course Info</th>
                            <th class="py-3 border-0">Course Code</th>
                            <th class="py-3 border-0 text-center">Status</th>
                            <th class="py-3 border-0">Added On</th>
                            <th class="py-3 px-4 border-0 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($courses as $course)
                        <tr>
                            <td class="py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <div class="mr-3 text-muted font-weight-light">#{{ $course->id }}</div>
                                    <span class="font-weight-bold text-dark">{{ $course->name }}</span>
                                </div>
                            </td>

                            <td class="py-3">
                                <span class="badge badge-light border text-monospace px-2 py-1" style="letter-spacing: 1px;">
                                    {{ $course->code }}
                                </span>
                            </td>

                            <td class="py-3 text-center">
                                @if($course->active)
                                    <span class="badge badge-soft-success rounded-pill px-3 py-2">
                                        <i class="fas fa-check-circle mr-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge badge-soft-secondary rounded-pill px-3 py-2">
                                        <i class="fas fa-times-circle mr-1"></i> Inactive
                                    </span>
                                @endif
                            </td>

                            <td class="py-3 text-muted small">
                                <div>{{ $course->created_at->format('M d, Y') }}</div>
                                <div style="font-size: 0.7rem;">{{ $course->created_at->format('h:i A') }}</div>
                            </td>

                            <td class="py-3 px-4 text-center">
                                <div class="btn-group shadow-sm rounded-lg" role="group">
                                    <a href="{{route('courses.edit',$course->id)}}" class="btn btn-white btn-sm border" title="Edit">
                                        <i class="fas fa-pen text-warning"></i>
                                    </a>
                                    
                                    <form action="{{route('courses.destroy',$course)}}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-white btn-sm border border-left-0" 
                                                onclick="return confirm('Delete this course?');" title="Delete">
                                            <i class="fas fa-trash-alt text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <i class="fas fa-folder-open fa-3x text-light mb-3 d-block"></i>
                                <span class="text-muted">No courses available yet. Start by adding one!</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($courses->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            <div class="d-flex justify-content-end">
                {{ $courses->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection