@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        :title="__('Locations')"
        :breadcrumbs="[
            ['label' => __('Dashboard'), 'url' => route('admin.dashboard')],
            ['label' => __('Locations')]
        ]">
        @can('create locations')
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">{{ __('Add') }} {{ __('Locations') }}</button>
        @endcan
    </x-admin.page-header>

    @if (session('success'))
        <div class="alert alert-dismissible alert-success fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <x-admin.card>
        <table class="align-middle table table-hover">
            <thead>
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Image') }}</th>
                    <th class="text-end">{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody id="locationTable">
                @foreach ($Locations as $location)
                    @include('admin.location._row', ['location' => $location])
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $Locations->links() }}
        </div>
    </x-admin.card>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form hx-post="{{ route('locations.store') }}"
                  hx-target="#locationTable"
                  hx-swap="beforeend"
                  hx-on::after-request="if(event.detail.successful) bootstrap.Modal.getInstance(document.getElementById('createModal')).hide(); this.reset();"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add New Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" required accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="htmx-indicator me-1 spinner-border spinner-border-sm" role="status"></span>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form hx-post="{{ route('locations.update', ':id') }}"
                  hx-on::after-request="if(event.detail.successful) bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <!-- Content loaded via HTMX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">
                        <span class="htmx-indicator me-1 spinner-border spinner-border-sm" role="status"></span>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Update form action when edit modal loads
    document.body.addEventListener('htmx:afterSwap', function(event) {
        if (event.detail.target.id === 'editModalBody') {
            const locationId = event.detail.target.querySelector('[name="location_id"]').value;
            const form = event.detail.target.closest('form');
            form.setAttribute('hx-post', "{{ route('locations.update', ':id') }}".replace(':id', locationId));
            form.setAttribute('hx-target', '#location-' + locationId);
            form.setAttribute('hx-swap', 'outerHTML');
            htmx.process(form);
        }
    });
</script>
@endsection
