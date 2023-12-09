<?php

namespace App\Http\Controllers;

use App\DataTables\CoursesDataTable;
use App\DataTables\StudentCoursesDataTable;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index(CoursesDataTable $dataTable) {
        return $dataTable->render('courses.index');
    }

    public function studentCourses(StudentCoursesDataTable $dataTable, Student $student) {
        return $dataTable->with(['student' => $student])->render('courses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course) {
        return view('courses.show', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course) {
        //
    }
}
