@props(['title' => null, 'class' => '', 'borderless' => false])

<div class="m-3 card {{ $borderless ? 'border-0 shadow-none' : 'shadow-sm' }} {{ $class }}">
    @if($title || isset($actions))
        <div class="card-header {{ $borderless ? 'border-0 bg-transparent' : 'bg-white' }} d-flex justify-content-between align-items-center">
            @if($title)
                <h5 class="mb-0 card-title">{{ $title }}</h5>
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
