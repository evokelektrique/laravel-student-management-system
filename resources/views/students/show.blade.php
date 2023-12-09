@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $student->full_name }}</div>
            <div class="card-body">
                <a class="btn btn-success" href="{{route('course.studentCourses', $student)}}">Courses</a>
            </div>
        </div>
    </div>
@endsection
