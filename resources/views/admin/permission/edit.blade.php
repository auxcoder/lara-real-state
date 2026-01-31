@extends('admin.layout.master')
@section('content')
<!-- Start Content-->
<div class="container-xxl">

    <div class="d-flex flex-column flex-sm-row align-items-sm-center py-3">
        <div class="flex-grow-1">
            <h4 class="m-0 fs-18 fw-semibold">Create Form</h4>
        </div>

        <div class="text-end">
            <ol class="m-0 py-0 breadcrumb">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                <li class="active breadcrumb-item">Create Form</li>
            </ol>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="mb-0 card-title">Create Form</h5>
                    <form method="post" action="{{ route('permission.update', $permission->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="my-3 form-group">
                                <label for="name">Name</label>
                                <input value="{{$permission->name}}" type="text" id="name" name="name" class="form-control" placeholder="Name">
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div><!-- end card header -->

                <div class="card-body">

                </div>

            </div>
        </div>

    </div>
</div>
</div>
</div>
@endsection
