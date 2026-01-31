@props(['title' => null])

<div class="card shadow-sm">
    @if($title || isset($actions))
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            @if($title)
                <h5 class="card-title mb-0">{{ $title }}</h5>
            @endif
            @isset($actions)
                <div class="card-actions">
                    {{ $actions }}
                </div>
            @endisset
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
