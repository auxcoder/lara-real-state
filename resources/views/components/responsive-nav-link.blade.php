@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav-link active border-start border-primary border-4 bg-primary bg-opacity-10 text-primary'
            : 'nav-link text-muted border-start border-4 border-transparent';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
