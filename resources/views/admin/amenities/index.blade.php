@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        :title="__('Amenities')"
        :breadcrumbs="[
            ['label' => __('Dashboard'), 'url' => route('admin.dashboard')],
            ['label' => __('Amenities')]
        ]"
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create amenities')
                <a href="{{ route('amenity.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>{{ __('Add') }} {{ __('Amenities') }}
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Logo') }}</th>
                        <th>{{ __('Description') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Amenity as $amenity)
                        <tr>
                            <td>{{ $amenity->id }}</td>
                            <td>{{ $amenity->name }}</td>
                            <td><img src="{{ asset('storage/' . $amenity->logo) }}" width="50" height="50" class="rounded"></td>
                            <td>{{ Str::limit($amenity->description, 50) }}</td>
                            <td class="text-end">
                                <x-admin.crud-actions
                                    :showRoute="route('Amenity.show', $amenity->id)"
                                    :editRoute="route('Amenity.edit', $amenity->id)"
                                    :deleteRoute="route('Amenity.destroy', $amenity->id)"
                                    editPermission="edit amenities"
                                    deletePermission="delete amenities"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-center text-muted">{{ __('no_records') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($Amenity->hasPages())
                <div class="mt-3">
                    {{ $Amenity->links() }}
                </div>
            @endif
        </div>
    </x-admin.card>
</div>
@endsection
