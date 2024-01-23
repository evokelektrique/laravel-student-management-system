<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\DataTables\StudentsDataTable;
use App\Models\StudentCertificate;
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
     * Display the specified resource.
     */
    public function show_certificates(Student $student) {
        if ($student->user->id !== auth()->user()->id) {
            return redirect()->back();
        }

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

    public function download_certificate(Request $request, Student $student, int $type) {
        if (auth()->user()->id !== $student->user->id && auth()->user()->isAdmin() === false) {
            return redirect()->back()->with('error', "Unauthorized");
        }

        $certificate_type = null;
        $certificates = $this->studentRepository->can_get_certificate($student);
        // dd($certificates);
        if (
            !$certificates['base'] &
            !$certificates['required'] &
            !$certificates['specialization'] &
            !$certificates['project']
        ) {
            return redirect()->back()->with('error', "مجاز به دریافت مدرک نمی باشید - دروس پایه - اختصاصی - پروژه پاس نشدند");
        }

        if ($type === 1) {
            if ($certificates['optional-executive-engineering-package'] && $certificates['optional-executive-engineering-package-remaining'] === 0) {
                $certificate_type = 1;
            } else {
                return redirect()->back()->with('error', " جهت دریافت مدرک 'کهاد بسته مدیریت اجرایی' مجاز به دریافت مدرک نمی باشید - نیازمند پاس کردن "  . $certificates['optional-executive-engineering-package-remaining'] . " واحد می باشید");
            }
        }

        if ($type === 2) {
            if ($certificates['optional-information-systems'] && $certificates['optional-information-systems-remaining'] === 0) {
                $certificate_type = 2;
            } else {
                return redirect()->back()->with('error', " جهت دریافت مدرک 'کهاد بسته سیستم های اطلاعاتی' مجاز به دریافت مدرک نمی باشید - نیازمند پاس کردن "  . $certificates['optional-information-systems-remaining'] . " واحد می باشید");
            }
        }

        if ($type === 3) {
            if ($certificates['optional-production-and-services-systems'] && $certificates['optional-production-and-services-systems-remaining'] === 0) {
                $certificate_type = 3;
            } else {
                return redirect()->back()->with('error', " جهت دریافت مدرک 'کهاد بسته سیستم های تولیدی و خدماتی' مجاز به دریافت مدرک نمی باشید - نیازمند پاس کردن "  . $certificates['optional-production-and-services-systems-remaining'] . " واحد می باشید");
            }
        }

        if (!$certificate_type) {
            return redirect()->back()->with('error', "مجاز به دریافت مدرک نمی باشید");
        }

        $filename = "$certificate_type.png";
        $certificate = $student->certificates()->create([]);
        $imageContent = $this->generate_certificate_image($filename, $certificate_type, $student, $certificate);

        // Set the appropriate headers for the response
        $headers = [
            'Content-Type' => 'image/png', // Adjust the content type based on your image type
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        // Return the response with the image file
        return response()->make($imageContent, 200, $headers);
    }

    public function convertEnglishNumbersToPersian($string) {
        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        $convertedString = str_replace($english, $persian, $string);

        return $convertedString;
    }

    public function generate_certificate_image(string $filename, int $certificate_type, Student $student, StudentCertificate $certificate): string {

        // Set the locale to Persian
        Carbon::setLocale('fa');

        // Get the current date and time
        $now = Carbon::now();

        // Convert the Carbon date to Jalali (Shamsi) date
        $jalaliDate = Jalalian::fromCarbon($now);
        // Format the Jalali date in a human-readable representation
        $formattedTimeISO = $now->isoFormat('Y/m/d');
        $formattedTimeJalali = $jalaliDate->format('Y/m/d');

        // Assuming your images are stored in the "public/images" directory
        $path = public_path("images/$filename");

        // Check if the file exists
        if (!file_exists($path)) {
            abort(404);
        }

        // Create a new image instance
        $image = imagecreatefrompng($path);

        $full_name_rev = \PersianRender\PersianRender::render($student->full_name);
        $full_name = '';
        for ($j = mb_strlen($full_name_rev); $j >= 0; $j--) {
            $full_name .= mb_substr($full_name_rev, $j, 1);
        }

        $head_of_department_persian_rev = \PersianRender\PersianRender::render("مهدی مرادی گوهره");
        $head_of_department_persian = '';
        for ($j = mb_strlen($head_of_department_persian_rev); $j >= 0; $j--) {
            $head_of_department_persian .= mb_substr($head_of_department_persian_rev, $j, 1);
        }

        // Set text color
        $textColor = imagecolorallocate($image, 0, 0, 0); // RGB values for the color

        // Set the appropriate font file path
        $fontPath = base_path('public/fonts/Arial.ttf');

        // Write text at a certain position
        imagettftext($image, 14, 0, 190, 148, $textColor, $fontPath, $certificate->id);  // Certificate Number
        imagettftext($image, 14, 0, 745, 148, $textColor, $fontPath, $this->convertEnglishNumbersToPersian($certificate->id));  // Persian Date

        imagettftext($image, 14, 0, 745, 184, $textColor, $fontPath, $this->convertEnglishNumbersToPersian($formattedTimeJalali));  // Persian Date
        imagettftext($image, 14, 0, 210, 183, $textColor, $fontPath, $formattedTimeISO);     // English Date

        imagettftext($image, 16, 0, 515, 322, $textColor, $fontPath, $full_name);                                                    // Persian Name
        imagettftext($image, 16, 0, 365, 450, $textColor, $fontPath, $student->full_name_english);                                   // English Name
        imagettftext($image, 16, 0, 285, 322, $textColor, $fontPath, $this->convertEnglishNumbersToPersian($student->national_id));  // Persian number
        imagettftext($image, 14, 0, 805, 450, $textColor, $fontPath, $student->national_id);                                         // English number

        imagettftext($image, 14, 0, 260, 580, $textColor, $fontPath, $head_of_department_persian);  // Head of department Persian name
        imagettftext($image, 14, 0, 620, 580, $textColor, $fontPath, "Mehdy Morady Gohareh");       // Head of department English name

        // Output the image to the browser
        ob_start();
        imagepng($image);
        $imageContent = ob_get_clean();

        // Clean up resources
        imagedestroy($image);

        return $imageContent;
    }
}
