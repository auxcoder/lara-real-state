@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header 
        :title="__('Master Plans')" 
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => __('Master Plans')]
        ]" 
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create master plans')
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    <i class="bi bi-plus-circle me-1"></i>Add Master Plan
                </button>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody id="masterPlanTable">
                    @forelse ($masterPlans as $masterPlan)
                        @include('admin.master_plans._row', ['masterPlan' => $masterPlan])
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">{{ __('no_records') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $masterPlans->links() }}
            </div>
        </div>
    </x-admin.card>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form hx-post="{{ route('master-plans.store') }}"
                  hx-target="#masterPlanTable"
                  hx-swap="beforeend"
                  hx-on::after-request="if(event.detail.successful) bootstrap.Modal.getInstance(document.getElementById('createModal')).hide(); this.reset();"
                  enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-plus-circle me-2"></i>Add New Master Plan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" id="image" required accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" required>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <span class="htmx-indicator spinner-border spinner-border-sm me-1" role="status"></span>
                        <i class="bi bi-check-circle me-1"></i>Save
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
            <form hx-post="{{ route('master-plans.update', ':id') }}"
                  hx-on::after-request="if(event.detail.successful) bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-pencil me-2"></i>Edit Master Plan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <!-- Content loaded via HTMX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-success">
                        <span class="htmx-indicator spinner-border spinner-border-sm me-1" role="status"></span>
                        <i class="bi bi-check-circle me-1"></i>Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.body.addEventListener('htmx:afterSwap', function(event) {
        if (event.detail.target.id === 'editModalBody') {
            const masterplanId = event.detail.target.querySelector('[name="masterplan_id"]').value;
            const form = event.detail.target.closest('form');
            form.setAttribute('hx-post', "{{ route('master-plans.update', ':id') }}".replace(':id', masterplanId));
            form.setAttribute('hx-target', '#masterplan-' + masterplanId);
            form.setAttribute('hx-swap', 'outerHTML');
            htmx.process(form);
        }
    });
</script>
@endsection
