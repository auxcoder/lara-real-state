@props(['type' => 'info', 'message'])

<div x-data="{ show: true }" 
     x-show="show" 
     x-init="setTimeout(() => show = false, 4000)"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="alert alert-{{ $type }} alert-dismissible fade show shadow-sm mb-2" 
     role="alert">
    {{ $message }}
    <button type="button" class="btn-close" @click="show = false" aria-label="Close"></button>
</div>
