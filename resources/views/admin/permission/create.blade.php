@extends('admin.layout.master')
@section('content')
<!-- Start Content-->
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="d-flex flex-column flex-sm-row align-items-sm-center py-3">
                <div class="flex-grow-1">
                    <h4 class="m-0 fs-18 fw-semibold">Premission Form</h4>
                </div>

                <div class="text-end">
                    <ol class="m-0 py-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="active breadcrumb-item">Premission Form</li>
                    </ol>
                </div>
            </div>


            @if(Session::has('error'))
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
                            <h5 class="mb-0 card-title">Create Form</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="{{ route('permission.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <strong>Name:</strong>
                                            <input name="name" placeholder="Name" class="my-4 form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                </div><!-- end card header -->
            </div>
        </div>
    </div>

</div>
</div>
</div>
@endsection
