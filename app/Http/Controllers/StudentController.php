<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\DataTables\StudentsDataTable;
use App\Repositories\StudentRepository;
use ArPHP\I18N\Arabic;
use Carbon\Carbon;
use GuzzleHttp\Psr7\Response;
use Intervention\Image\ImageManager;
use Morilog\Jalali\Jalalian;

class StudentController extends Controller {
    public function __construct(private StudentRepository $studentRepository) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(StudentsDataTable $dataTable) {
        return $dataTable->render('students.index');
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
    public function show(Student $student) {
        return view('students.show', ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student) {
        //
    }

    public function download_certificate(Request $request, User $user) {
        if (auth()->user()->id !== $user->id || auth()->user()->isAdmin() === true) {
            return redirect()->back()->with('error', "Unauthorized");
        }

        // Set the locale to Persian
        Carbon::setLocale('fa');

        // Get the current date and time
        $now = Carbon::now();

        // Convert the Carbon date to Jalali (Shamsi) date
        $jalaliDate = Jalalian::fromCarbon($now);
        // Format the Jalali date in a human-readable representation
        $formattedTimeISO = $now->isoFormat('Y/m/d');
        $formattedTimeJalali = $jalaliDate->format('Y/m/d');

        $certificate_type = 1;

        $student = $user->student;
        $certificates = $this->studentRepository->can_get_certificate($student);

        if (
            !$certificates['optional-information-systems'] &&
            !$certificates['optional-production-and-services-systems']
        ) {
            $certificate_type = 1;
        }

        if (!$certificates['optional-executive-engineering-package'] && !$certificates['optional-production-and-services-systems']) {
            $certificate_type = 2;
        }

        if (!$certificates['optional-executive-engineering-package'] && !$certificates['optional-information-systems']) {
            $certificate_type = 3;
        }

        if (!$certificate_type) {
            return redirect()->back()->with('error', "مجاز به دریافت مدرک نمی باشید");
        }

        // Assuming your images are stored in the "public/images" directory
        $filename = "$certificate_type.png";
        $path = public_path("images/$filename");

        // Check if the file exists
        if (!file_exists($path)) {
            abort(404);
        }

        // Create a new image instance
        $image = imagecreatefrompng($path);

        $full_name_rev = \PersianRender\PersianRender::render($student->full_name);
        $student_number_rev = $student->student_number;
        $full_name = '';
        for ($j = mb_strlen($full_name_rev); $j >= 0; $j--) {
            $full_name .= mb_substr($full_name_rev, $j, 1);
        }

        // Set text color
        $textColor = imagecolorallocate($image, 0, 0, 0); // RGB values for the color

        // Set the appropriate font file path
        $fontPath = base_path('public/fonts/Arial.ttf');

        // Write text at a certain position


        imagettftext($image, 14, 0, 745, 184, $textColor, $fontPath, $formattedTimeJalali);  // Persian Date
        imagettftext($image, 14, 0, 210, 183, $textColor, $fontPath, $formattedTimeISO);     // English Date

        imagettftext($image, 16, 0, 515, 322, $textColor, $fontPath, $full_name);                                                  // Persian Name
        imagettftext($image, 16, 0, 365, 450, $textColor, $fontPath, $full_name);                                                  // English Name
        imagettftext($image, 16, 0, 285, 322, $textColor, $fontPath, $this->convertEnglishNumbersToPersian($student_number_rev));  // Persian number
        imagettftext($image, 14, 0, 805, 450, $textColor, $fontPath, $student->student_number);                                    // English number

        // Set the appropriate headers for the response
        $headers = [
            'Content-Type' => 'image/png', // Adjust the content type based on your image type
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Output the image to the browser
        ob_start();
        imagepng($image);
        $imageContent = ob_get_clean();

        // Clean up resources
        imagedestroy($image);


        // Return the response with the image file
        return response()->make($imageContent, 200, $headers);
    }

    public function convertEnglishNumbersToPersian($string) {
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        $convertedString = str_replace($english, $persian, $string);

        return $convertedString;
    }
}
