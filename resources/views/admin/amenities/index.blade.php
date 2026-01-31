@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        title="Amenities" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => 'Amenities']
        ]" 
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create', App\Models\Amenity::class)
                <a href="{{ route('amenity.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Add Amenity
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Description</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($Amenity as $amenity)
                        <tr>
                            <td>{{ $amenity->id }}</td>
                            <td>{{ $amenity->name }}</td>
                            <td><img src="{{ asset('storage/' . $amenity->logo) }}" width="50" height="50" class="rounded"></td>
                            <td>{{ Str::limit($amenity->description, 50) }}</td>
                            <td class="text-end">
                                <x-admin.crud-actions 
                                    :showRoute="route('Amenity.show', $amenity->id)"
                                    :editRoute="route('Amenity.edit', $amenity->id)"
                                    :deleteRoute="route('Amenity.destroy', $amenity->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No amenities found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-admin.card>
</div>
@endsection
                                            hx-confirm="Delete {{ $amenity->name }}?"
                                            hx-target="closest tr"
                                            hx-swap="outerHTML swap:1s">
                                        Delete
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $Amenity->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
