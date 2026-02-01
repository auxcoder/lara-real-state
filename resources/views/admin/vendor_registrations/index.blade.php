@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        :title="__('Vendor Registrations')" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => __('Vendor Registrations')]
        ]" 
    />

    <x-admin.card>
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Contact Person') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
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
                                @can('view vendor registrations')
                                    <a href="{{ route('vendor-registrations.show', $registration) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">{{ __('no_records') }}</td>
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
