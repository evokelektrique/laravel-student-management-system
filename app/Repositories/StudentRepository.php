<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository {
    public function __construct() {
    }

    public function can_get_certificate(Student $student): array {
        $hasPassedCourses = [
            'base'           => $student->hasPassedAllCoursesByType($this->getCoursesByType('base')),
            'required'       => $student->hasPassedAllCoursesByType($this->getCoursesByType('required')),
            'specialization' => $student->hasPassedCoursesByMinimumUnits(18, 'تخصصی 1'),
            'project'        => $student->hasPassedCourse('پروژه'),

            'optional-executive-engineering-package'           => $student->hasPassedCoursesByMinimumUnits(15, 'اختياري بسته مهندسي اجرايي'),
            'optional-executive-engineering-package-remaining' => $student->unitsNeededToReachMinimum(15, 'اختياري بسته مهندسي اجرايي'),

            'optional-information-systems'           => $student->hasPassedCoursesByMinimumUnits(15, 'اختياري سیستم های اطلاعاتی'),
            'optional-information-systems-remaining' => $student->unitsNeededToReachMinimum(15, 'اختياري سیستم های اطلاعاتی'),

            'optional-production-and-services-systems'           => $student->hasPassedCoursesByMinimumUnits(15, 'اختياري سیستم های تولیدی و خدماتی'),
            'optional-production-and-services-systems-remaining' => $student->unitsNeededToReachMinimum(15, 'اختياري سیستم های تولیدی و خدماتی'),
        ];

        return $hasPassedCourses;
    }

    private function getCoursesByType(string $type) {
        if (!$type) {
            throw new \Exception('No course type defined');
        }

        $courses = [
            'base' => [
                'رياضي 1',
                'رياضي 2',
                'محاسبات عددي',
                'معادلات ديفرانسيل',
                'فيزيك 1',
                'فيزيك 2',
                'آز فيزيك 1',
                'آز فيزيك 2',
                'برنامه نويسي كامپيوتر',
            ],
            'required' => [
                'مباني اقتصاد',
                'اصول حسابداري',
                'اقتصاد مهندسي',
                'اصول مديريت و سازمان',
                'نظريه احتمال و کاربردها',
                'آمار مهندسي',
                'کنترل کیفیت آماري',
                'جبر خطي',
                'بهینه سازي 1',
                'بهینه سازي 2',
                'تحليل سيستم ها',
                'برنامه ریزي و کنترل موجودي 1',
                'مديریت و کنترل پروژه',
                'نقشه کشی صنعتي',
                'مبانی مهندسي برق',
                'استاتیک و مقاومت مصالح',
                'علم مواد',
                'روش های تولید',
                'ارزيابی کار و زمان',
                'طرح ريزی واحد هاي صنعتی',
                'روش تحقيق و گزارش نويسي',
                'کارگاه ماشين ابزار 1',
                'کارگاه عمومي جوش',
                'کارگاه ريخته گری، ذوب و مدل سازي',
                'کارآموزي                ',
            ],
        ];

        return $courses[$type];
    }
}
