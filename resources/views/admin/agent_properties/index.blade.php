@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        title="Properties"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Properties']
        ]"
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create', App\Models\AgentProperty::class)
                <a href="{{ route('property.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add New Property
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Price</th>
                        <th>Area (sq meter)</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($properties as $property)
                        <tr>
                            <td>{{ $property->id }}</td>
                            <td>{{ $property->translations->pluck('title')->implode(' | ') }}</td>
                            <td>{{ $property->location }}</td>
                            <td>{{ $property->property_type }}</td>
                            <td>
                                @if (!is_null($property->price))
                                    AED {{ number_format($property->price, 2) }}
                                @else
                                    {{ __('properties.contact_for_price') }}
                                @endif
                            </td>
                            <td>{{ $property->area }}</td>
                            <td>
                                <span class="bg- badge{{ $property->status === 'available' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($property->status) }}
                                </span>
                            </td>
                            <td class="text-end">
                                <x-admin.crud-actions
                                    :showRoute="route('property.show', $property->id)"
                                    :editRoute="route('property.edit', $property->id)"
                                    :deleteRoute="route('property.destroy', $property->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 text-center text-muted">No properties found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($properties->hasPages())
            <div class="mt-3">
                {{ $properties->links() }}
            </div>
        @endif
    </x-admin.card>
</div>
@endsection
