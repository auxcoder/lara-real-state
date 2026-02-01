@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        :title="__('Developers')"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => __('Developers')]
        ]"
    />

    <x-admin.card class="mb-4">
        <x-slot name="actions">
            @can('create developers')
                <a href="{{ route('developers.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add Developer
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="align-middle table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Phone') }}</th>
                        <th>{{ __('Logo') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($developers as $developer)
                        <tr>
                            <td>{{ $developer->name }}</td>
                            <td>{{ $developer->email }}</td>
                            <td>{{ $developer->phone }}</td>
                            <td>
                                @if ($developer->logo)
                                    <img src="{{ asset('storage/' . $developer->logo) }}" alt="{{ $developer->name }}" width="50" class="rounded">
                                @else
                                    <span class="text-muted">No Logo</span>
                                @endif
                            </td>
                            <td>
                                <span class="bg- badge{{ $developer->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($developer->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <x-admin.crud-actions
                                    :showRoute="route('developers.show', $developer->id)"
                                    :editRoute="route('developers.edit', $developer->id)"
                                    :deleteRoute="route('developers.destroy', $developer->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-4 text-center text-muted">{{ __('no_records') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $developers->links() }}
        </div>
    </x-admin.card>
</div>
@endsection
