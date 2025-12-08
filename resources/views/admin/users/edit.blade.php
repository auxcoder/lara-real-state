@extends('admin.layout.master')
@section('content')
    <!-- Start Content-->
    <div class="container-xxl">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit Form</h4>
            </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                    <li class="breadcrumb-item active">Edit Form</li>
                </ol>
            </div>
        </div>

        @if (Session::has('error'))
            <p class="alert alert-info">{{ Session::get('error') }}</p>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <!-- General Form -->

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Form</h5>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form method="post" class="" action="{{ route('users.update', $user->id ) }}">

                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group my-2">
                                        <strong>Name:</strong>
                                        <input class="form-control my-2" value="{{$user->name}}" type="text" id="name" name="name" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group my-2">
                                        <strong>Email:</strong>
                                        <input class="form-control my-2" value="{{$user->email}}"  id="email" name="email" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group my-2">
                                        <strong>Password:</strong>
                                        <input class="form-control my-2" type="password" id="password" name="password" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <strong>Confirm Password:</strong>
                                        <input class="form-control my-2" type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {{-- @dd(config('permission.teams')); // This should output `false` --}}

                                        <strong>Role:</strong>
                                        <select name="roles" class="form-control my-2 text-capitalize" required>
                                            <option>Select role</option>
                                            @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ in_array($role->name, $userRole) ? 'selected' : '' }} class="text-capitalize">{{ $role->name }}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- end card header -->
                </div>
            </div>
        </div>
    </div>
@endsection
