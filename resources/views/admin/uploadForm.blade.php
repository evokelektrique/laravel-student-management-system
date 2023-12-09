@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-dismissible alert-success">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('admin.import') }}" method="post" enctype="multipart/form-data" class="form">
                    @csrf
                    <label for="file" class="mb-2">Choose Excel file:</label>
                    <div class="input-group">
                        <input class="form-control" type="file" name="file" accept=".xlsx, .xls">
                        <button class="btn btn-outline-success" type="submit">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
