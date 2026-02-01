@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Developer Property Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Developer Properties', 'url' => route('developer_properties.index')],
            ['label' => 'View']
        ]" 
    />

    <x-admin.card class="mb-4">
        <x-slot name="actions">
            @can('update', $developer)
                <a href="{{ route('developer_properties.edit', $developer->id) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
            @endcan
        </x-slot>

        <div class="row">
            <div class="col-md-8">
                <table class="table align-middle table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $developer->name }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $developer->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td>{{ $developer->phone }}</td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-{{ $developer->status == 'active' ? 'success' : 'danger' }}">
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
                                    <img src="{{ $developer->logo }}" alt="{{ $developer->name }} Logo" width="150" class="img-thumbnail">
                                @else
                                    <span class="text-muted">No logo available</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('developer_properties.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>
    </x-admin.card>
</div>
@endsection
