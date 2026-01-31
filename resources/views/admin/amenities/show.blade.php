@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Amenity Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Amenities', 'url' => route('amenity.index')],
            ['label' => 'View']
        ]" 
    />

    <x-admin.card class="mb-4">
        <x-slot name="actions">
            <a href="{{ route('Amenity.edit', $amenity->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
        </x-slot>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $amenity->name }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $amenity->description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Logo:</th>
                            <td>
                                @if($amenity->logo)
                                    <img src="{{ asset('storage/' . $amenity->logo) }}" width="100" class="rounded">
                                @else
                                    <span class="text-muted">No logo</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('Amenity.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>
    </x-admin.card>
</div>
@endsection
