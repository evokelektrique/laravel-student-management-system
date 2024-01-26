@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('داشبورد') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                خوش آمدید {{ auth()->user()->name }} عزیز, لطفا از نوار بار بالا جهت انجام عملیات های خود استفاده کنید.
            </div>
        </div>
    </div>
@endsection
