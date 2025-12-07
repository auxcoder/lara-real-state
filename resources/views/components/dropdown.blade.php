@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white dark:bg-gray-700'])

@php
switch ($align) {
    case 'left':
        $alignmentClasses = 'dropdown-menu-start';
        break;
    case 'top':
        $alignmentClasses = 'origin-top';
        break;
    case 'right':
        default:
        $alignmentClasses = 'dropdown-menu-end';
    break;
}

switch ($width) {
    case '48':
        $width = 'w-48';
        break;
}
@endphp

<div class="nav-item dropdown" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <a class="nav-link dropdown-toggle" href="#" role="button" aria-expanded="false" @click="open = ! open">
        {{ $trigger }}
    </a>

    <ul class="dropdown-menu {{ $width }} {{ $alignmentClasses }}"
        x-show="open"
        x-on:click.away="open = false"
        @click="open = false">
        {{ $content }}
    </ul>
</div>
