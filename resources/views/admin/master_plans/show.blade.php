@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Master Plan Details" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Master Plans', 'url' => route('master-plans.index')],
            ['label' => 'View']
        ]" 
    />

    <x-admin.card class="mb-4">
        <x-slot name="actions">
            <a href="{{ route('master-plans.edit', $masterPlan->id) }}" class="btn btn-primary btn-sm">
                <i class="bi bi-pencil me-1"></i>Edit
            </a>
        </x-slot>

        <div class="row">
            <div class="col-md-8">
                <table class="table align-middle table-borderless">
                    <tbody>
                        <tr>
                            <th width="200">Name:</th>
                            <td>{{ $masterPlan->name }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $masterPlan->description ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Image:</th>
                            <td>
                                @if($masterPlan->image)
                                    <img src="{{ asset('storage/' . $masterPlan->image) }}" width="200" class="rounded">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Created:</th>
                            <td>{{ $masterPlan->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Updated:</th>
                            <td>{{ $masterPlan->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('master-plans.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to List
            </a>
        </div>
    </x-admin.card>
</div>
@endsection