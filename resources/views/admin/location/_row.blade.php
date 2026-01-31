<tr id="location-{{ $location->id }}">
    <td>{{ $location->id }}</td>
    <td>{{ $location->name }}</td>
    <td><img src="{{ asset('storage/' . $location->image) }}" width="50" height="50"></td>
    <td class="text-end">
        @can('edit locations')
            <button class="btn btn-warning btn-sm"
                    hx-get="{{ route('locations.edit', $location->id) }}"
                    hx-target="#editModalBody"
                    data-bs-toggle="modal"
                    data-bs-target="#editModal">
                {{ __('Edit') }}
            </button>
        @endcan
        @can('delete locations')
            <button class="btn btn-danger btn-sm"
                    hx-delete="{{ route('locations.destroy', $location->id) }}"
                    hx-confirm="{{ __('confirm.delete', ['item' => $location->name]) }}"
                    hx-target="#location-{{ $location->id }}"
                    hx-swap="outerHTML swap:1s">
                {{ __('Delete') }}
            </button>
        @endcan
    </td>
</tr>
