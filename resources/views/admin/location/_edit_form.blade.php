<div class="mb-3">
    <label for="editName" class="form-label">Name</label>
    <input type="text" class="form-control" id="editName" name="name" value="{{ $location->name }}" required>
</div>
<div class="mb-3">
    <label for="editImage" class="form-label">Image</label>
    <input type="file" class="form-control" id="editImage" name="image" accept="image/*">
    <img src="{{ asset('storage/' . $location->image) }}" width="100" class="mt-2">
</div>
<div class="mb-3">
    <label for="editDescription" class="form-label">Description</label>
    <input type="text" class="form-control" id="editDescription" name="description" value="{{ $location->description }}" required>
</div>
<input type="hidden" name="location_id" value="{{ $location->id }}">
