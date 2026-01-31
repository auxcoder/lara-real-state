@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Agent Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Agents', 'url' => route('agents.index')],
            ['label' => 'View']
        ]" 
    />

    <x-admin.card class="mb-4">
        <x-slot name="actions">
            <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
        </x-slot>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $agent->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $agent->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $agent->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>License Number:</th>
                            <td>{{ $agent->license_number ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Bio:</th>
                            <td>{{ $agent->bio ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-{{ $agent->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($agent->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Profile Image:</th>
                            <td>
                                @if($agent->profile_image)
                                    <img src="{{ asset('storage/' . $agent->profile_image) }}" width="100" class="rounded">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('agents.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>
    </x-admin.card>
</div>
@endsection
