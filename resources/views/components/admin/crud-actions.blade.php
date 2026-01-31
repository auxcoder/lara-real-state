@props(['editRoute', 'deleteRoute', 'showRoute' => null, 'editPermission' => null, 'deletePermission' => null, 'viewPermission' => null])

<div class="btn-group" role="group">
    @if($showRoute && (!$viewPermission || auth()->user()->can($viewPermission)))
        <a href="{{ $showRoute }}" class="btn btn-sm btn-info" title="View">
            <i class="bi bi-eye"></i>
        </a>
    @endif
    @if(!$editPermission || auth()->user()->can($editPermission))
        <a href="{{ $editRoute }}" class="btn btn-sm btn-primary" title="Edit">
            <i class="bi bi-pencil"></i>
        </a>
    @endif
    @if(!$deletePermission || auth()->user()->can($deletePermission))
        <form action="{{ $deleteRoute }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    @endif
</div>
