@extends('admin.layout.master')

@section('content')
<div class="container">
    <x-admin.page-header
        :title="__('Blogs')"
        :breadcrumbs="[
            ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
            ['label' => __('Blogs')]
        ]"
    />

    <x-admin.card>
        <x-slot name="actions">
            @can('create', App\Models\Blog::class)
                <a href="{{ route('blogs.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-1"></i>Create New Blog
                </a>
            @endcan
        </x-slot>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('ID') }}</th>
                        <th>{{ __('Title') }}</th>
                        <th>{{ __('Image') }}</th>
                        <th class="text-end">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>{{ $blog->translate()->title }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->translate()->title }}" width="80" class="rounded">
                            </td>
                            <td class="text-end">
                                <x-admin.crud-actions
                                    :editRoute="route('blogs.edit', $blog->id)"
                                    :deleteRoute="route('blogs.destroy', $blog->id)"
                                />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-muted">{{ __('no_records') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($blogs->hasPages())
                <div class="mt-3">
                    {{ $blogs->links() }}
                </div>
            @endif
        </div>
    </x-admin.card>
</div>
@endsection
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }
</script>
@endsection
