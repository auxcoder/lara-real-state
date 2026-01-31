@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Developer Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Developers', 'url' => route('developers.index')],
            ['label' => 'View']
        ]" 
    />

    <x-admin.card>
        <x-slot name="actions">
            <a href="{{ route('developers.edit', $developer->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
        </x-slot>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $developer->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $developer->email ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $developer->phone ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-{{ $developer->status == 'active' ? 'success' : 'secondary' }}">
                                    {{ ucfirst($developer->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $developer->description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Logo:</th>
                            <td>
                                @if($developer->logo)
                                    <img src="{{ asset('storage/' . $developer->logo) }}" width="150" class="rounded">
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
            <a href="{{ route('developers.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>
    </x-admin.card>
</div>
@endsection
