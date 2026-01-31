<tr id="masterplan-{{ $masterPlan->id }}">
    <td>{{ $masterPlan->id }}</td>
    <td>{{ $masterPlan->name }}</td>
    <td><img src="{{ asset('storage/' . $masterPlan->image) }}" width="50" height="50"></td>
    <td class="text-end">
        <button class="btn btn-warning btn-sm"
                hx-get="{{ route('master-plans.edit', $masterPlan->id) }}"
                hx-target="#editModalBody"
                data-bs-toggle="modal"
                data-bs-target="#editModal">
            Edit
        </button>
        <button class="btn btn-danger btn-sm"
                hx-delete="{{ route('master-plans.destroy', $masterPlan->id) }}"
                hx-confirm="Delete {{ $masterPlan->name }}?"
                hx-target="#masterplan-{{ $masterPlan->id }}"
                hx-swap="outerHTML swap:1s">
            Delete
        </button>
    </td>
</tr>
