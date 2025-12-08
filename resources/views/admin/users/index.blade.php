@extends('admin.layout.master')

@section('content')
<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">User List</h4>
        </div>

        <div class="text-end">
            <ol class="breadcrumb m-0 py-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                <li class="breadcrumb-item active">List</li>
            </ol>
        </div>
    </div>

    <!-- Datatables  -->
    <div class="user">
        <div class="col-12">
            <a href="/admin/users/create" class="btn btn-primary mt-3">Create</a>

            <table id="datatable" class="table dt-responsive table-responsive nowrap">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->getRoleNames()->isNotEmpty())
                                    {{-- {{ $user->getRoleNames() }} --}}
                                    @foreach ($user->getRoleNames() as $v)
                                        <label class="badge bg-success text-capitalize">
                                            {{ $v }}</label>
                                    @endforeach
                                @endif
                            </td>
                            <td class="d-flex gap-2">

                                <a class="btn btn-primary"
                                    href="{{ route('users.edit', ['user' => $user->id]) }}">Edit</a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Are You sure you want to delete this?')">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
