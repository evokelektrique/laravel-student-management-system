@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ $course->course_name }}</div>
            <div class="card-body">
                <div class="row row-cols-auto gy-4">
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header">شماره ترم</div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $course->semester_number }}</h4>
                                <p class="card-text text-muted">شماره ترم مربوط به جریان تحصیلی این درس</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header">کد درس</div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $course->course_group_id }}</h4>
                                <p class="card-text text-muted">کد یکتای نشان‌دهنده درس مرتبط در سیستم</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header">نوع درس</div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $course->course_type }}</h4>
                                <p class="card-text text-muted">نوع درس از نظر محتوا یا نحوه ارائه، مانند اختیاری یا اجباری</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header">وضعیت درس</div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $course->course_status }}</h4>
                                <p class="card-text text-muted">وضعیت فعلی درس مانند عادی یا تخصصی</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header">تعداد واحد درس</div>
                            <div class="card-body">
                                <h4 class="card-title">{{ $course->course_number_of_units }}</h4>
                                <p class="card-text text-muted">تعداد واحدهای اختصاص یافته به این</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
