@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Vendor Registrations</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="align-middle table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Contact Person</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $registration)
                        <tr>
                            <td>{{ $registration->id }}</td>
                            <td>{{ $registration->name }}</td>
                            <td>{{ $registration->email }}</td>
                            <td>{{ $registration->phone_number }}</td>
                            <td>{{ $registration->contact_person_name }}</td>
                            <td>{{ $registration->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm"
                                    href="{{ route('vendor-registrations.show', $registration) }}">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No registrations yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
