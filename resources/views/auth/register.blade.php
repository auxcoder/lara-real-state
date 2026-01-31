<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from zoyothemes.com/kadso/html/auth-register by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Jul 2024 10:45:01 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="utf-8" />
    <title>Register | Kadso - Responsive Admin Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">
    @vite(['resources/css/admin.scss', 'resources/js/admin.js'])
</head>

<body class="bg-color">
    <!-- Begin page -->
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12">
                <div class="p-0">
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-6 col-md-6 col-xl-6">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <div class="mb-0 border-0">
                                        <div class="p-0">
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <a class='auth-logo' href='{{ route('home') }}'>
                                                        <img src="/assets/images/logo-dark.png" alt="logo-dark"
                                                            class="mx-auto" height="28" />
                                                    </a>
                                                </div>

                                                <div class="mb-3 auth-title-section">
                                                    <h3 class="mb-2 text-dark fs-20 fw-medium">Get's started</h3>
                                                    <p class="mb-0 text-capitalize text-dark fs-14">Please enter your
                                                        details.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-0">
                                            <form action="{{ route('register') }}" class="my-4" method="POST">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                                        <div>{{ $errors->first() }}</div> <button
                                                            type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    {{-- <div class="alert alert-danger alert-block">
                                                        <button type="button" class="close"
                                                            data-dismiss="alert">×</button>
                                                        <strong></strong>
                                                    </div> --}}
                                                @endif
                                                @csrf
                                                <div class="mb-3 form-group">
                                                    <label for="username" class="form-label">Username</label>
                                                    <input class="form-control" name="name" type="text"
                                                        id="username" required="" placeholder="Enter your Username">
                                                </div>

                                                <div class="mb-3 form-group">
                                                    <label for="emailaddress" class="form-label">Email address</label>
                                                    <input class="form-control" name="email" type="email"
                                                        id="emailaddress" required="" placeholder="Enter your email">
                                                </div>

                                                <div class="mb-3 form-group">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input class="form-control" name="password" type="password"
                                                        required="" id="password" placeholder="Enter your password">
                                                </div>

                                                <div class="mb-3 form-group">
                                                    <label for="password" class="form-label">Confirmed Password</label>
                                                    <input class="form-control" name="password_confirmation" type="password"
                                                           required id="password" placeholder="Enter your confirmed password">
                                                </div>

                                                <div class="d-flex mb-3 form-group">
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input"
                                                                id="checkbox-signin">
                                                            <label class="form-check-label" for="checkbox-signin">I
                                                                agree to the <a href="#"
                                                                    class="text-primary fw-medium"> Terms and
                                                                    Conditions</a></label>
                                                        </div>
                                                    </div><!--end col-->
                                                </div>

                                                <div class="row mb-0 form-group">
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary" type="submit">
                                                                Register</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="text-center text-muted">
                                                <p class="mb-0">Already have an account ?<a
                                                        class='text-primary fw-medium ms-2' href='/login'>Login
                                                        here</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="col-lg-6 col-md-6 col-xl-6 d-flex justify-content-center p-0 account-page-bg vh-100">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="/assets/libs/node-waves/waves.min.js"></script>

</body>

<!-- Mirrored from zoyothemes.com/kadso/html/auth-register by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 01 Jul 2024 10:45:01 GMT -->

</html>
