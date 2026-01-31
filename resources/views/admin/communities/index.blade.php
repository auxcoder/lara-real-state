@extends('admin.layout.master')

@section('content')
<div class="container">
    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Communities</h1>
        @can('create', App\Models\Community::class)
            <a href="{{ route('communities.create') }}" class="btn btn-primary">Add Community</a>
        @endcan
    </div>

    {{-- Success Message --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Data Table --}}
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($communities as $community)
                        <tr>
                            <td>{{ $community->name }}</td>
                            <td>{{ Str::limit($community->description, 50) }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $community->image) }}" alt="{{ $community->name }}" width="80" class="img-thumbnail">
                            </td>
                            <td class="text-end">
                                @can('update', $community)
                                    <a href="{{ route('communities.edit', $community->id) }}" class="btn btn-sm btn-warning" title="Edit">Edit</a>
                                @endcan
                                
                                @can('delete', $community)
                                    <form action="{{ route('communities.destroy', $community) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">Delete</button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No communities found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
                                                value="{{ $community->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea name="description" class="form-control">{{ $community->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="feature_description" class="form-label">Feature Description</label>
                                            <textarea name="feature_description" class="form-control">{{ $community->feature_description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Image</label>
                                            <input type="file" accept="image/*" name="image" class="form-control">
                                        </div>
                                        @if ($community->image)
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Current Image</label>
                                                <img src="{{ asset('storage/' . $community->image) }}"
                                                    alt="community Image" class="img-thumbnail" width="150">
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label">Select Amenities:</label>
                                            <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                                                @foreach ($amenities as $amenity)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" 
                                                               name="amenities[]" 
                                                               value="{{ $amenity->id }}" 
                                                               id="edit_amenity_{{ $community->id }}_{{ $amenity->id }}"
                                                               {{ in_array($amenity->id, $community->amenities->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="edit_amenity_{{ $community->id }}_{{ $amenity->id }}">
                                                            {{ $amenity->name }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="location" class="form-label">Select Location:</label>
                                            <select id="location" class="form-select" name="location">
                                                @php
                                                    $locations = [
                                                        'Dubai',
                                                        'Abu Dhabi',
                                                        'Sharjah',
                                                        'Al Ain',
                                                        'Fujairah',
                                                    ];
                                                @endphp
                                                @foreach ($locations as $location)
                                                    <option value="{{ $location }}"
                                                        {{ $community->location == $location ? 'selected' : '' }}>
                                                        {{ $location }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

        <!-- Add Modal -->
        <div class="modal fade" id="communityModal" tabindex="-1" aria-labelledby="communityModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('communities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="communityModalLabel">Add Community</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="feature_description" class="form-label">Feature Description</label>
                                <textarea name="feature_description" class="form-control"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" accept="image/*" name="image" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Select Amenities:</label>
                                <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                                    @foreach ($amenities as $amenit)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="amenities[]" 
                                                   value="{{ $amenit->id }}" 
                                                   id="create_amenity_{{ $amenit->id }}">
                                            <label class="form-check-label" for="create_amenity_{{ $amenit->id }}">
                                                {{ $amenit->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="location">Select Location:</label>
                                <select id="location" class="form-control" name="location">
                                    <option value="Dubai">Dubai</option>
                                    <option value="Abu Dhabi">Abu Dhabi</option>
                                    <option value="Sharjah">Sharjah</option>
                                    <option value="Al Ain">Al Ain</option>
                                    <option value="Fujairah">Fujairah</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Community</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
