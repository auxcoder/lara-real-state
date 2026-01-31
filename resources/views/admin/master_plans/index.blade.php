@extends('admin.layout.master')

@section('content')
<div class="container mt-5">
    <h1>Master Plans</h1>
    <button class="mb-3 btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add New Master Plan</button>



    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="masterPlanTable">
            @foreach ($masterPlans as $masterPlan)
                <tr id="masterPlanRow{{ $masterPlan->id }}">
                    <td>{{ $masterPlan->id }}</td>
                    <td>{{ $masterPlan->name }}</td>
                    <td><img src="{{ asset('storage/' . $masterPlan->image) }}" width="100"></td>
                    <td>
                        <button class="btn btn-warning" onclick="editMasterPlan({{ $masterPlan->id }})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteMasterPlan({{ $masterPlan->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="createForm" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Add New Master Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="createName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="createImage" name="image" required
                            accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="createDescription" name="description" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Master Plan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editImage" class="form-label">Image</label>
                        <input type="file" class="form-control" id="editImage" name="image" accept="image/*">
                        <img id="editPreview" src="" width="100" class="mt-2" style="display: none;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const updateUrl = "{{ route('master-plans.update', ':id') }}";
    const deleteUrl = "{{ route('master-plans.destroy', ':id') }}";
    // Create Master Plan
    document.getElementById('createForm').onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch("{{ route('master-plans.store') }}", {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const newRow = `
                <tr id="masterPlanRow${data.masterPlan.id}">
                    <td>${data.masterPlan.id}</td>
                    <td>${data.masterPlan.name}</td>
                    <td><img src="/storage/${data.masterPlan.image}" width="100"></td>
                    <td>
                        <button class="btn btn-warning" onclick="editMasterPlan(${data.masterPlan.id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteMasterPlan(${data.masterPlan.id})">Delete</button>
                    </td>
                </tr>
            `;
                    document.getElementById('masterPlanTable').insertAdjacentHTML('beforeend', newRow);
                    document.getElementById('createForm').reset();
                    $('#createModal').modal('hide');
                }
            });
    };

    // Edit Master Plan
    function editMasterPlan(id) {
        // Get the row containing the Master Plan data
        const row = document.getElementById(`masterPlanRow${id}`);

        // Retrieve name and image source directly from the table
        const name = row.children[1].textContent;
        const imageSrc = row.children[2].children[0].src;

        // Set values in the edit form
        document.getElementById('editName').value = name;
        document.getElementById('editForm').setAttribute('action', updateUrl.replace(':id', id));
        document.getElementById('editPreview').src = imageSrc;
        document.getElementById('editPreview').style.display = 'block';

        // Show the edit modal
        $('#editModal').modal('show');
    }


    // Update Master Plan
    document.getElementById('editForm').onsubmit = function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch(this.action, {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const row = document.getElementById(`masterPlanRow${data.masterPlan.id}`);
                    row.children[1].textContent = data.masterPlan.name;
                    row.children[2].children[0].src = `{{ asset('storage') }}/${data.masterPlan.image}`;
                    document.getElementById('editForm').reset();
                    $('#editModal').modal('hide');
                }
            });
    };

    // Delete Master Plan
    function deleteMasterPlan(id) {
        if (confirm('Are you sure you want to delete this Master Plan?')) {
            fetch(deleteUrl.replace(':id', id), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`masterPlanRow${id}`).remove();
                    }
                });
        }
    }
</script>
@endsection
