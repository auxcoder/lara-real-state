<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('company.name') }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-countryside-fav.png') }}">
    @vite(['resources/css/admin.scss', 'resources/js/admin.js'])
</head>

<body data-menu-color="dark" data-sidebar="default">
    <div id="wrapper">
        <div id="sidebarWrapper" class="bg-dark">
            @include('admin.layout.sidebar')
        </div>

        <div id="contentWrapper">
            <div class="navbar navbar-expand-md shadow">
                <div class="container-fluid">
                    <button class="bg-transparent nav-link border-0 button-toggle-menu">
                        <i class="bi bi-list fs-4"></i>
                    </button>

                    <div class="d-flex align-items-center gap-3 ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="/assets/images/users/user-11.jpg" alt="user-image" class="rounded-circle" width="35">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person-circle me-2"></i>My Account
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </div>

            <div class="content-page">
                <div class="content">
                    <!-- Toast Container -->
                    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
                        @if (session('success'))
                            <x-toast type="success" :message="session('success')" />
                        @endif
                        @if (session('error'))
                            <x-toast type="danger" :message="session('error')" />
                        @endif
                        @if (session('info'))
                            <x-toast type="info" :message="session('info')" />
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <x-toast type="danger" :message="$error" />
                            @endforeach
                        @endif
                    </div>

                    @yield('content')
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="text-center text-muted text-sm col small">
                            &copy; {{ date('Y') }} - Made with <span class="text-danger bi bi-heart-fill"></span> by <a
                                href="#!" class="text-reset fw-semibold">Auxcoder</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @vite(['resources/css/admin.scss', 'resources/js/admin.js'])
    @yield('scripts')
</body>

</html>
