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
                    <h5 class="mb-0 card-title">Roles List</h5>
                <a href="/admin/roles/create" class="mt-3 btn btn-primary">Create</a>

                </div><!-- end card header -->

                <div class="card-body">
                    <table id="datatable" class="dt-responsive nowrap table table-bordered table-responsive">
                        <thead>
                        <tr>
                        <th>S.No</th>
                        <th>Roles</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php
                                $id = 1
                            @endphp
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $id++ }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Edit</a>

                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger"
                                            hx-delete="{{ route('roles.destroy', $role->id) }}"
                                            hx-confirm="Delete role {{ $role->name }}?"
                                            hx-target="closest tr"
                                            hx-swap="outerHTML swap:1s">
                                        Delete
                                    </button>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="mt-3">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
