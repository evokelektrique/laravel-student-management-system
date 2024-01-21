<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return view('admin.home');
        }

        $student = $user->student;
        $coursesBasic = $student->coursesByType('پايه');
        $coursesRequired = $student->coursesByType('اصلي');
        $coursesMandatory = $student->coursesByType('تخصصی 1');
        $coursesMandatory2 = $student->coursesByType('تخصصی 2');
        $coursesBaseMandatory = $student->coursesByType('عمومی اجباری');

        return view('home', compact('coursesBasic', 'coursesRequired', 'coursesMandatory', 'coursesMandatory2', 'coursesBaseMandatory'));
    }
}
