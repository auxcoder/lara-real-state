@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link active border-bottom border-primary border-2'
            : 'nav-link text-muted';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
