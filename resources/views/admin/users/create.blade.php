@extends('admin.layout.master')

@section('content')
<!-- Start Content-->
<div class="container-xxl">
    <div class="d-flex flex-column flex-sm-row align-items-sm-center py-3">
        <div class="flex-grow-1">
            <h4 class="m-0 fs-18 fw-semibold">User Form</h4>
        </div>

        <div class="text-end">
            <ol class="m-0 py-0 breadcrumb">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                <li class="active breadcrumb-item">User Form</li>
            </ol>
        </div>
    </div>

    @if (Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
    @endif

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- General Form -->

    <div class="card">

        <div class="card-header">
            <h5 class="mb-0 card-title">Create Form</h5>
        </div><!-- end card header -->

        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <form method="post" class="" action="{{ route('users.store') }}">
                        @if ($errors->any())
                            <div class="alert alert-block alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $errors->first() }}</strong>
                            </div>
                        @endif
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input class="my-2 form-control" name="name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <strong>Email:</strong>
                                    <input class="my-2 form-control" type="email" name="email" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <strong>Password:</strong>
                                    <input class="my-2 form-control" type="password" name="password" required>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <strong>Confirm Password:</strong>
                                    <input class="my-2 form-control" type="password" name="confirm-password"
                                        required>
                                    @error('confirm-password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    {{-- @dd(config('permission.teams')); // This should output `false` --}}

                                    <strong>Role:</strong>
                                    <select name="roles" class="my-2 text-capitalize form-control" required>
                                        <option>Select role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" class="text-capitalize">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6 text-center">
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
