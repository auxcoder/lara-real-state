@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Vendor Registrations" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Vendor Registrations']
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
                        <th>Contact Person</th>
                        <th>Submitted</th>
                        <th class="text-end">Actions</th>
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
                            <td>{{ $registration->created_at->format('M d, Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('vendor-registrations.show', $registration) }}" class="btn btn-primary btn-sm">
                                    <i class="bi bi-eye me-1"></i>View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No registrations found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($registrations->hasPages())
            <div class="mt-3">
                {{ $registrations->links() }}
            </div>
        @endif
    </x-admin.card>
</div>
@endsection
