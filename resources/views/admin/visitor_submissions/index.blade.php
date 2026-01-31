@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Visitor Submissions" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Visitor Submissions']
        ]" 
    />

    <x-admin.card>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Nationality</th>
                        <th>Rent For</th>
                        <th>Submitted</th>
                        <th class="text-end">Actions</th>
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
                            <td>{{ $submission->created_at->format('M d, Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('visitor-submissions.show', $submission) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i>View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No submissions found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($submissions->hasPages())
            <div class="mt-3">
                {{ $submissions->links() }}
            </div>
        @endif
    </x-admin.card>
</div>
@endsection

