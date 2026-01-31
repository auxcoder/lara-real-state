@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        title="Edit Property"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Properties', 'url' => route('property.index')],
            ['label' => 'Edit']
        ]"
    />

    <x-admin.card class="mb-4" borderless>
        <form action="{{ route('property.update', $property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.agent_properties._form')

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Update Property
                </button>
                <a href="{{ route('property.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
