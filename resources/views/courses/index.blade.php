@extends('layout/starter-en')

@section('title','Courses')

@section('path','Courese')

@section('pageName','Courses')

@section('content')
    <div class="container bg-white p-4 shadow-sm rounded">
      <!-- Header Section -->
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 text-dark">Course List</h3>
        <a href="{{route('courses.create')}}" class="btn btn-primary shadow-sm" role="button">
          <i class="fas fa-plus"></i> Add New Course
        </a>
      </div>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="thead-light">
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Code</th>
              <th>Status</th>
              <th>Created At</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($courses->isEmpty())
            <tr>
              <td colspan="6" class="text-center py-4 text-muted">No data available in this table</td>
            </tr>
            @else
            @foreach($courses as $course)
            <tr>
              <td>{{$course->id}}</td>
              <td class="font-weight-bold">{{$course->name}}</td>
              <td><code>{{$course->code}}</code></td>
              <td>
                @if($course->active)
                <span class="badge badge-success px-3 py-2">Activated</span>
                @else
                <span class="badge badge-danger px-3 py-2">Not Activated</span>
                @endif
              </td>
              <td class="text-muted">{{$course->created_at->format('d-m-Y h:i A')}}</td>
              <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                  <a class="btn btn-sm btn-warning mr-1" href="{{route('courses.edit',$course->id)}}">Edit</a>
                  
                  <form action="{{route('courses.destroy',$course)}}" method="post" class="m-0">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                  </form>
                </div>
              </td>
            </tr>
            @endforeach
            @endif
          </tbody>
        </table>
      </div>
    </div>
@endsection
