@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Add New Property" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Properties', 'url' => route('property.index')],
            ['label' => 'Create']
        ]" 
    />

    <x-admin.card>
        <form action="{{ route('property.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.agent_properties._form')
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle me-1"></i>Create Property
                </button>
                <a href="{{ route('property.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </a>
            </div>
        </form>
    </x-admin.card>
</div>
@endsection
