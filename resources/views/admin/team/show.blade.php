@extends('admin.layout.master')

@section('content')
<x-admin.page-header
    title="Team Member Details"
    :breadcrumbs="[
        ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
        ['label' => 'Team Members', 'url' => route('team.index')],
        ['label' => 'View Member']
    ]"
>
    <div class="d-flex gap-2">
        <a href="{{ route('team.edit', $team->id) }}" class="btn btn-warning">
            <i class="fa-edit fas"></i> Edit
        </a>
        <a href="{{ route('team.index') }}" class="btn btn-secondary">
            <i class="fa-arrow-left fas"></i> Back
        </a>
    </div>
</x-admin.page-header>

<x-admin.card class="mb-4">
    <div class="row">
        <div class="col-md-4">
            @if($team->image)
                <img src="{{ asset('uploads/' . $team->image) }}" class="rounded img-fluid" alt="{{ $team->name }}">
            @else
                <div class="d-flex justify-content-center align-items-center bg-light rounded" style="height: 200px;">
                    <i class="text-muted fa-3x fa-user fas"></i>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <h3>{{ $team->name }}</h3>
            <p class="text-muted">{{ $team->position }}</p>
            <p><strong>Email:</strong> {{ $team->email }}</p>
            <p><strong>ID:</strong> {{ $team->NID }}</p>

            @if($team->specialties)
                <p><strong>Specialties:</strong> {{ $team->specialties }}</p>
            @endif

            @if($team->description)
                <p><strong>Description:</strong> {{ $team->description }}</p>
            @endif

            @if($team->experience)
                <p><strong>Experience:</strong> {{ $team->experience }}</p>
            @endif

            @if($team->languages)
                <p><strong>Languages:</strong> {{ $team->languages }}</p>
            @endif

            <div class="mt-3">
                @if($team->facebook)
                    <a href="{{ $team->facebook }}" class="btn btn-outline-primary btn-sm me-2" target="_blank">
                        <i class="fa-facebook fab"></i> Facebook
                    </a>
                @endif
                @if($team->twitter)
                    <a href="{{ $team->twitter }}" class="btn btn-outline-info btn-sm me-2" target="_blank">
                        <i class="fa-twitter fab"></i> Twitter
                    </a>
                @endif
                @if($team->linkedin)
                    <a href="{{ $team->linkedin }}" class="btn btn-outline-primary btn-sm me-2" target="_blank">
                        <i class="fa-linkedin fab"></i> LinkedIn
                    </a>
                @endif
                @if($team->instagram)
                    <a href="{{ $team->instagram }}" class="btn btn-outline-danger btn-sm" target="_blank">
                        <i class="fa-instagram fab"></i> Instagram
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-admin.card>
@endsection
