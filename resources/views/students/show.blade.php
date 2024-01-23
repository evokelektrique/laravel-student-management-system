@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $student->full_name }}</div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @enderror

                <a class="btn btn-success" href="{{ route('course.studentCourses', $student) }}">درس ها</a>
                <a class="btn btn-success"
                    href="{{ route('student.download_certificate', ['student' => $student, 'type' => 1]) }}">مدرک کهاد
                    بسته
                    مدیریت اجرایی</a>
                <a class="btn btn-success"
                    href="{{ route('student.download_certificate', ['student' => $student, 'type' => 2]) }}">مدرک کهاد
                    بسته
                    سیستم های اطلاعاتی</a>
                <a class="btn btn-success"
                    href="{{ route('student.download_certificate', ['student' => $student, 'type' => 3]) }}">مدرک کهاد
                    بسته
                    سیستم های تولیدی و خدماتی</a>
        </div>
    </div>
</div>
@endsection
