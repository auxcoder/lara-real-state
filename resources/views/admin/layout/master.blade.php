<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The H Real Estate</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-countryside-fav.png') }}">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    @vite(['resources/css/admin.scss', 'resources/js/admin.js'])
    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body data-menu-color="dark" data-sidebar="default">
    <div id="wrapper">
        <div id="sidebarWrapper" class="bg-dark">
            @include('admin.layout.sidebar')
        </div>

        <div id="contentWrapper">
            <div class="navbar navbar-expand-md shadow">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="d-flex justify-content-between navbar-collapse collapse" id="navbarNav">
                        <ul class="d-flex justify-content-end align-items-center mb-0 navbar-nav">
                            <li class="mavbar-item">
                                <button class="nav-link button-toggle-menu">
                                    <i data-feather="menu" class="noti-icon"></i>
                                </button>
                            </li>

                            <form class="d-flex topbar-search">
                                <input type="text" class="bg-light bg-opacity-75 border-light form-control ps-4" placeholder="Search...">
                                <i class="position-absolute top-50 text-muted bi bi-magnify fs-16 ms-2 translate-middle-y"></i>
                            </form>
                        </ul>

                        <ul class="d-flex justify-content-end align-items-center mb-0 navbar-nav">
                            <li class="mavbar-item">
                                <button class="nav-link button-toggle-menu">
                                    <i data-feather="menu" class="noti-icon"></i>
                                </button>
                            </li>

                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                                    aria-haspopup="false" aria-expanded="false">
                                        Inbox
                                    <span class="bg-danger rounded-pill badge">99+<span class="visually-hidden">unread messages</span></span>
                                </a>

                                <div class="dropdown-lg dropdown-menu dropdown-menu-end">
                                    <div class="dropdown-item noti-title">
                                        <h5 class="m-0">
                                            <span class="float-end"><a href="#" class="text-dark"><small>Clear All</small></a></span>Notification
                                        </h5>
                                    </div>

                                    <div class="noti-scroll">
                                        <a href="javascript:void(0);" class="dropdown-item">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="/assets/images/users/user-12.jpg" class="rounded-circle img-fluid" alt="avatar" width="30"  />

                                                <div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="">Carl Steadham</span>
                                                        <small class="text-muted">5 min ago</small>
                                                    </div>

                                                    <p class="mb-0 text-muted">
                                                        <small class="fs-sm">Completed <span class="text-reset">Improve workflow in Figma</span></small>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="javascript:void(0);" class="text-muted link-primary dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="/assets/images/users/user-2.jpg" class="rounded-circle img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="notify-content">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="notify-details">Olivia McGuire</p>
                                                    <small class="text-muted">1 min ago</small>
                                                </div>

                                                <p class="mb-1 user-msg">
                                                    <small class="fs-14">Added file to <span class="text-reset text-truncate">Create  for our iOS</span></small>
                                                </p>

                                                <div class="d-flex align-items-center mt-2">
                                                    <div class="notify-sub-icon">
                                                        <i class="text-dark mdi mdi-download-box"></i>
                                                    </div>

                                                    <div>
                                                        <p class="mb-0 notify-details">dark-themes.zip</p>
                                                        <small class="text-muted">2.4 MB</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>

                                        <a href="javascript:void(0);" class="text-muted link-primary dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="/assets/images/users/user-3.jpg" class="rounded-circle img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="notify-content">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="notify-details">Travis Williams</p>
                                                    <small class="text-muted">7 min ago</small>
                                                </div>
                                                <p class="mb-1 user-msg">
                                                    <small class="fs-14">Mentioned you in the <span
                                                        class="text-reset text-truncate">Rewrite text-button</span></small>
                                                </p>
                                                <p class="mb-0 mt-2 p-2 rounded-2 noti-mentioned"><span
                                                    class="text-primary">@Patryk</span> Please make sure that you're....
                                                </p>
                                            </div>
                                        </a>

                                        <a href="javascript:void(0);" class="text-muted link-primary dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="/assets/images/users/user-8.jpg" class="rounded-circle img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="notify-details">Violette Lasky</p>
                                                <small class="text-muted">5 min ago</small>
                                            </div>
                                            <p class="mb-0 user-msg">
                                                <small class="fs-14">Completed <span class="text-reset">Create new
                                                    components</span></small>
                                            </p>
                                        </a>

                                        <a href="javascript:void(0);"
                                            class="text-muted link-primary dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="/assets/images/users/user-5.jpg" class="rounded-circle img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="notify-details">Ralph Edwards</p>
                                                <small class="text-muted">5 min ago</small>
                                            </div>
                                            <p class="mb-0 user-msg">
                                                <small class="fs-14">Completed <span class="text-reset">Improve workflow in
                                                    React</span></small>
                                            </p>
                                        </a>

                                        <a href="javascript:void(0);"
                                            class="text-muted link-primary dropdown-item notify-item">
                                            <div class="notify-icon">
                                                <img src="/assets/images/users/user-6.jpg" class="rounded-circle img-fluid"
                                                    alt="" />
                                            </div>
                                            <div class="notify-content">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <p class="notify-details">Jocab jones</p>
                                                    <small class="text-muted">7 min ago</small>
                                                </div>
                                                <p class="mb-1 user-msg">
                                                    <small class="fs-14">Mentioned you in the <span
                                                        class="text-reset text-truncate">Rewrite text-button</span></small>
                                                </p>
                                                <p class="mb-0 mt-2 p-2 rounded-2 noti-mentioned"><span
                                                    class="text-reset">@Patryk</span> Please make sure that you're....</p>
                                            </div>
                                        </a>
                                    </div>

                                    <a href="javascript:void(0);"
                                        class="text-center text-primary dropdown-item notify-all notify-item">
                                        View all
                                        <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </li>

                            <li class="nav-item dropdown ">
                                <a class="nav-link dropdown-toggle" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                                    <img src="/assets/images/users/user-11.jpg" alt="user-image" class="rounded-circle" width="35" >
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                                    <li class='dropdown-item' href='pages-profile.html'>
                                        <i class="align-middle mdi mdi-account-circle-outline"></i>
                                        <span>My Account</span>
                                    </li>

                                    <li class='dropdown-item' href='auth-lock-screen.html'>
                                        <i class="align-middle fs-16 mdi mdi-lock-outline"></i>
                                        <span>Lock Screen</span>
                                    </li>

                                    {{-- <div class="dropdown-divider"></div> --}}

                                    <li class='dropdown-item' href='{{ route('logout') }}'>
                                        <i class="align-middle fs-16 mdi mdi-location-exit"></i>
                                        <span>Logout</span>
                                    </li>
                                </ul>
                            </li>
                        </ul>
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
                    <div class="row">
                        <div class="text-center text-muted col fs-13">
                            &copy; {{ date('Y') }} - Made with <span class="text-danger mdi mdi-heart"></span> by <a
                                href="#!" class="text-reset fw-semibold">Auxcoder</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const titleInput = document.getElementById("title_en");
            const slugInput = document.getElementById("slug");

            if (titleInput && slugInput) {
                titleInput.addEventListener("input", function() {
                    let title = titleInput.value;
                    let slug = title.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .trim()
                        .replace(/\s+/g, '-');
                    slugInput.value = slug;
                });
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
