@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row row-cols-auto g-4 align-items-center justify-content-center">
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header  text-center">دروس پایه</div>
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $coursesBasic->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header  text-center">اصلي</div>
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $coursesRequired->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header  text-center">تخصصی 1</div>
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $coursesMandatory->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header  text-center">عمومی اجباری</div>
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $coursesBaseMandatory->count() }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card bg-secondary mb-3">
                            <div class="card-header  text-center">تخصصی 2</div>
                            <div class="card-body">
                                <h4 class="card-title text-center">{{ $coursesMandatory2->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
