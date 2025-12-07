<!DOCTYPE html>
<html lang="en" translate="no">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The H Real Estate</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logo-footer01.png') }}">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- Toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Summernote CSS & JS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet"> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script> --}}
    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>

<body data-menu-color="dark" data-sidebar="default">
    <!-- Topbar Start -->
    <div class="topbar-custom">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                    <li>
                        <button class="button-toggle-menu nav-link">
                            <i data-feather="menu" class="noti-icon"></i>
                        </button>
                    </li>
                    <li class="d-none d-lg-block">
                        <div class="position-relative topbar-search">
                            <input type="text" class="form-control bg-light bg-opacity-75 border-light ps-4"
                                placeholder="Search...">
                            <i
                                class="mdi mdi-magnify fs-16 position-absolute text-muted top-50 translate-middle-y ms-2"></i>
                        </div>
                    </li>
                </ul>
                {{-- <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                            aria-haspopup="false" aria-expanded="false">
                            <i data-feather="bell" class="noti-icon"></i>
                            <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-lg">

                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-end">
                                        <a href="#" class="text-dark">
                                            <small>Clear All</small>
                                        </a>
                                    </span>Notification
                                </h5>
                            </div>

                            <div class="noti-scroll" data-simplebar>

                                <!-- item-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item notify-item text-muted link-primary active">
                                    <div class="notify-icon">
                                        <img src="/assets/images/users/user-12.jpg" class="img-fluid rounded-circle"
                                            alt="" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="notify-details">Carl Steadham</p>
                                        <small class="text-muted">5 min ago</small>
                                    </div>
                                    <p class="mb-0 user-msg">
                                        <small class="fs-14">Completed <span class="text-reset">Improve workflow in
                                                Figma</span></small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                    <div class="notify-icon">
                                        <img src="/assets/images/users/user-2.jpg" class="img-fluid rounded-circle"
                                            alt="" />
                                    </div>
                                    <div class="notify-content">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="notify-details">Olivia McGuire</p>
                                            <small class="text-muted">1 min ago</small>
                                        </div>
                                        <p class="mb-1 user-msg">
                                            <small class="fs-14">Added file to <span
                                                    class="text-reset text-truncate">Create dark mode for our
                                                    iOS</span></small>
                                        </p>

                                        <div class="d-flex mt-2 align-items-center">
                                            <div class="notify-sub-icon">
                                                <i class="mdi mdi-download-box text-dark"></i>
                                            </div>

                                            <div>
                                                <p class="notify-details mb-0">dark-themes.zip</p>
                                                <small class="text-muted">2.4 MB</small>
                                            </div>
                                        </div>

                                    </div>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item text-muted link-primary">
                                    <div class="notify-icon">
                                        <img src="/assets/images/users/user-3.jpg" class="img-fluid rounded-circle"
                                            alt="" />
                                    </div>
                                    <div class="notify-content">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="notify-details">Travis Williams</p>
                                            <small class="text-muted">7 min ago</small>
                                        </div>
                                        <p class="mb-1 user-msg">
                                            <small class="fs-14">Mentioned you in the <span
                                                    class="text-reset text-truncate">Rewrite text-button</span></small>
                                        </p>
                                        <p class="noti-mentioned p-2 rounded-2 mb-0 mt-2"><span
                                                class="text-primary">@Patryk</span> Please make sure that you're....
                                        </p>
                                    </div>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item notify-item text-muted link-primary">
                                    <div class="notify-icon">
                                        <img src="/assets/images/users/user-8.jpg" class="img-fluid rounded-circle"
                                            alt="" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="notify-details">Violette Lasky</p>
                                        <small class="text-muted">5 min ago</small>
                                    </div>
                                    <p class="mb-0 user-msg">
                                        <small class="fs-14">Completed <span class="text-reset">Create new
                                                components</span></small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item notify-item text-muted link-primary">
                                    <div class="notify-icon">
                                        <img src="/assets/images/users/user-5.jpg" class="img-fluid rounded-circle"
                                            alt="" />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <p class="notify-details">Ralph Edwards</p>
                                        <small class="text-muted">5 min ago</small>
                                    </div>
                                    <p class="mb-0 user-msg">
                                        <small class="fs-14">Completed <span class="text-reset">Improve workflow in
                                                React</span></small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);"
                                    class="dropdown-item notify-item text-muted link-primary">
                                    <div class="notify-icon">
                                        <img src="/assets/images/users/user-6.jpg" class="img-fluid rounded-circle"
                                            alt="" />
                                    </div>
                                    <div class="notify-content">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p class="notify-details">Jocab jones</p>
                                            <small class="text-muted">7 min ago</small>
                                        </div>
                                        <p class="mb-1 user-msg">
                                            <small class="fs-14">Mentioned you in the <span
                                                    class="text-reset text-truncate">Rewrite text-button</span></small>
                                        </p>
                                        <p class="noti-mentioned p-2 rounded-2 mb-0 mt-2"><span
                                                class="text-reset">@Patryk</span> Please make sure that you're....</p>
                                    </div>
                                </a>
                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);"
                                class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fe-arrow-right"></i>
                            </a>

                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#"
                            role="button" aria-haspopup="false" aria-expanded="false">
                            <img src="/assets/images/users/user-11.jpg" alt="user-image" class="rounded-circle">
                            <span class="pro-user-name ms-1">
                                Christian <i class="mdi mdi-chevron-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                            <!-- item-->
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome !</h6>
                            </div>

                            <!-- item-->
                            <a class='dropdown-item notify-item' href='pages-profile.html'>
                                <i class="mdi mdi-account-circle-outline fs-16 align-middle"></i>
                                <span>My Account</span>
                            </a>

                            <!-- item-->
                            <a class='dropdown-item notify-item' href='auth-lock-screen.html'>
                                <i class="mdi mdi-lock-outline fs-16 align-middle"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a class='dropdown-item notify-item' href='{{ route('logout') }}'>
                                <i class="mdi mdi-location-exit fs-16 align-middle"></i>
                                <span>Logout</span>
                            </a>

                        </div>
                    </li>

                </ul> --}}
            </div>

        </div>

    </div>
    <!-- end Topbar -->
    <div id="app-layout">
        <div class="content-page">
            <div class="content">

                @yield('content')


            </div>
        </div>
        @include('admin.layout.sidebar')
    </div>


    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col fs-13 text-muted text-center">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script> - Made with <span class="mdi mdi-heart text-danger"></span> by <a
                        href="#!" class="text-reset fw-semibold">Developer</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Vendor -->
    {{-- <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script> --}}
    <script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- Apexcharts JS -->
    {{-- <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

    <!-- Boxplot Charts Init Js -->
    {{-- <script src="{{ asset('assets/js/pages/apexcharts-pie.init.js') }}"></script> --}}

    <!-- App js-->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script>
        // toastr.info("{{ auth()->user()->id }}");

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif
        @if (session('error'))
            toastr.error("{{ session('error') }}")
        @endif
        @if (session('info'))
            toastr.info("{{ session('info') }}")
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.select2').select2();
            // $('#description').summernote({
            //     height: 200, // Set the height of the editor
            //     toolbar: [
            //         ['style', ['style']],
            //         ['font', ['bold', 'italic', 'underline', 'clear']],
            //         ['fontname', ['fontname']],
            //         ['fontsize', ['fontsize']],
            //         ['color', ['color']],
            //         ['para', ['ul', 'ol', 'paragraph']],
            //         ['table', ['table']],
            //         ['insert', ['link', 'picture', 'video']],
            //         ['view', ['fullscreen', 'codeview', 'help']]
            //     ]
            // });
            // $('.description').summernote({
            //     height: 200, // Set the height of the editor
            //     toolbar: [
            //         ['style', ['style']],
            //         ['font', ['bold', 'italic', 'underline', 'clear']],
            //         ['fontname', ['fontname']],
            //         ['fontsize', ['fontsize']],
            //         ['color', ['color']],
            //         ['para', ['ul', 'ol', 'paragraph']],
            //         ['table', ['table']],
            //         ['insert', ['link', 'picture', 'video']],
            //         ['view', ['fullscreen', 'codeview', 'help']]
            //     ]
            // });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const titleInput = document.getElementById("title_en");
            const slugInput = document.getElementById("slug");

            if (titleInput && slugInput) {
                titleInput.addEventListener("input", function() {
                    let title = titleInput.value;

                    // Slug banana: lowercase, special chars hatana, space ko dash me convert karna
                    let slug = title.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '') // special characters hatao
                        .trim()
                        .replace(/\s+/g, '-'); // spaces ko dash se replace

                    slugInput.value = slug;
                });
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')
</body>

</html>
