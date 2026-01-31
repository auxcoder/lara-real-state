<div class="mb-3">
    <label for="editName" class="form-label">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="editName" name="name" value="{{ $masterPlan->name }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="editImage" class="form-label">Image</label>
    @if($masterPlan->image)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $masterPlan->image) }}" width="100" class="rounded">
        </div>
    @endif
    <input type="file" class="form-control @error('image') is-invalid @enderror" id="editImage" name="image" accept="image/*">
    <small class="text-muted">Leave empty to keep current image</small>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label for="editDescription" class="form-label">Description</label>
    <input type="text" class="form-control @error('description') is-invalid @enderror" id="editDescription" name="description" value="{{ $masterPlan->description }}" required>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<input type="hidden" name="masterplan_id" value="{{ $masterPlan->id }}">
