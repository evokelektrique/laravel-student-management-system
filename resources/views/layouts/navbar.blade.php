<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('ورود') }}</a>
                        </li>
                    @endif
                @else
                    {{-- Admin menu --}}
                    @if (auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="btn btn-success" href="{{ route('admin.uploadForm') }}">{{ __('بارگذاری فرم') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('student.index') }}">{{ __('دانشجویان') }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('course.index') }}">{{ __('درس ها') }}</a>
                        </li>
                    @else
                        {{-- Student menu --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('course.studentCourses', auth()->user()->student) }}">{{ __('درس ها') }}</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('student.show_certificates', auth()->user()->student->id) }}">{{ __('دریافت مدرک') }}</a>
                        </li>
                    @endif


                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ auth()->user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                                {{ __('خروج') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
