<tr id="masterplan-{{ $masterPlan->id }}">
    <td>{{ $masterPlan->id }}</td>
    <td>{{ $masterPlan->name }}</td>
    <td><img src="{{ asset('storage/' . $masterPlan->image) }}" width="50" height="50" class="rounded"></td>
    <td class="text-end">
        @can('edit master plans')
            <button class="btn btn-warning btn-sm"
                    hx-get="{{ route('master-plans.edit', $masterPlan->id) }}"
                    hx-target="#editModalBody"
                    data-bs-toggle="modal"
                    data-bs-target="#editModal">
                <i class="bi bi-pencil me-1"></i>Edit
            </button>
        @endcan
        @can('delete master plans')
            <button class="btn btn-danger btn-sm"
                    hx-delete="{{ route('master-plans.destroy', $masterPlan->id) }}"
                    hx-confirm="Delete {{ $masterPlan->name }}?"
                    hx-target="#masterplan-{{ $masterPlan->id }}"
                    hx-swap="outerHTML swap:1s">
                <i class="bi bi-trash me-1"></i>Delete
            </button>
        @endcan
    </td>
</tr>
