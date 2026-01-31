<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8" />
    <title>Log In </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login page" />
    <meta name="author" content="Auxcoder" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container-fluid bg-light">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-lg-4 col-md-4 col-xl-4">
                <div class="mx-auto text-center" style="max-width: 400px">
                    <div class="mb-4">
                        <a class='text-decoration-none' href='{{ route('home') }}'>
                            <img class="auth-logo" src="{{ asset('assets/img/logo-countryside-c.jpeg') }}" alt="logo-dark" class="mx-auto" height="150" />
                        </a>
                    </div>

                    <div class="mb-3">
                        <h3 class="mb-2 text-dark fs-20 fw-medium">
                            <a class='text-decoration-none' href='{{ route('home') }}'>Welcome back</a>
                        </h3>
                        <p class="mb-0 text-capitalize text-dark fs-14">Please enter your details.</p>
                    </div>
                </div>

                <div class="mx-auto x-auto" style="max-width: 400px">
                    <form action="{{ route('login') }}" method="POST" class="my-4">
                        {{-- Display error message if exists --}}
                        @if ($errors->any())
                            <div class="alert alert-block alert-danger">
                                <button type="button" class="close"
                                    data-dismiss="alert">×</button>
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                        @endif

                        @csrf
                        <div class="mb-3 form-group">
                            <label for="emailaddress" class="form-label">Email address</label>
                            <input class="form-control" type="email" id="emailaddress"
                                name="email" required placeholder="Enter your email">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3 form-group">
                            <label for="password" class="form-label">Password</label>
                            <input class="form-control" type="password" id="password"
                                name="password" required placeholder="Enter your password">
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex mb-3 form-group">
                            <div class="col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input"
                                        id="checkbox-signin" name="remember">
                                    <label class="form-check-label"
                                        for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="col-sm-6 text-end">
                                <a class='text-muted fs-14' href='auth-recoverpw.html'>Forgot password?</a>
                            </div>
                        </div>

                        <div class="form-group ">
                             <button class="btn btn-primary w-100" type="submit">Log In</button>
                        </div>
                    </form>

                    <div class="text-center text-muted">
                        Don't have an account ?<a class='text-primary fw-medium ms-2' href='/register'>Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/js-flash-message@1.0.8/index.min.js"></script>
</body>

</html>
