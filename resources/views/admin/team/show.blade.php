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
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('team.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</x-admin.page-header>

<x-admin.card>
    <div class="row">
        <div class="col-md-4">
            @if($team->image)
                <img src="{{ asset('uploads/' . $team->image) }}" class="img-fluid rounded" alt="{{ $team->name }}">
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="fas fa-user fa-3x text-muted"></i>
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
                        <i class="fab fa-facebook"></i> Facebook
                    </a>
                @endif
                @if($team->twitter)
                    <a href="{{ $team->twitter }}" class="btn btn-outline-info btn-sm me-2" target="_blank">
                        <i class="fab fa-twitter"></i> Twitter
                    </a>
                @endif
                @if($team->linkedin)
                    <a href="{{ $team->linkedin }}" class="btn btn-outline-primary btn-sm me-2" target="_blank">
                        <i class="fab fa-linkedin"></i> LinkedIn
                    </a>
                @endif
                @if($team->instagram)
                    <a href="{{ $team->instagram }}" class="btn btn-outline-danger btn-sm" target="_blank">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-admin.card>
@endsection