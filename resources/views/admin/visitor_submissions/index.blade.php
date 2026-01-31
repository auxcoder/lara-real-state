@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Visitor Submissions</h4>
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
                        <th>Nationality</th>
                        <th>Rent For</th>
                        <th>Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($submissions as $submission)
                        <tr>
                            <td>{{ $submission->id }}</td>
                            <td>{{ $submission->name }}</td>
                            <td>{{ $submission->email }}</td>
                            <td>{{ $submission->phone_number }}</td>
                            <td>{{ $submission->nationality }}</td>
                            <td>{{ $submission->payment_for_rent }}</td>
                            <td>{{ $submission->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('visitor-submissions.show', $submission) }}">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No submissions yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div>
                {{ $submissions->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

