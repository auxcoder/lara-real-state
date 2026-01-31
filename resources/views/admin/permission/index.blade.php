@extends('admin.layout.master')

@section('content')
<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="d-flex flex-column flex-sm-row align-items-sm-center py-3">
                <div class="flex-grow-1">
                    <h4 class="m-0 fs-18 fw-semibold">List</h4>
                </div>

                <div class="text-end">
                    <ol class="m-0 py-0 breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="active breadcrumb-item">List</li>
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

            <!-- Datatables  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="mb-0 card-title">Permission List</h5>
                        <a href="/admin/permission/create" class="mt-3 btn btn-primary">Create</a>

                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="dt-responsive nowrap table table-bordered table-responsive">
                                <thead>
                                <tr>
                                <th>S.No</th>
                                <th>Permissions</th>
                                <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1
                                    @endphp
                                    @foreach ($permissions as $permission)
                                    <tr>
                                        <td>{{ $id++ }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{ route('permission.edit', $permission->id) }}">Edit</a>
                                        </td>
                                        <td>
                                            <form method="POST" action="{{ route('permission.destroy', $permission->id) }}">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger"  onclick="return confirm('Are You sure you want to delete this?')">Delete</button>
                                            </form>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
