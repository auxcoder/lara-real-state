@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        :title="__('Visitor Submissions')" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => __('Visitor Submissions')]
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
                        <th>{{ __('Nationality') }}</th>
                        <th>{{ __('Rent For') }}</th>
                        <th>{{ __('Created At') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
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
                                @can('view visitor submissions')
                                    <a href="{{ route('visitor-submissions.show', $submission) }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye me-1"></i>View
                                    </a>
                                @endcan
                                @can('delete visitor submissions')
                                    <form action="{{ route('visitor-submissions.destroy', $submission) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this submission?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">{{ __('no_records') }}</td>
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

