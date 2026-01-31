@props(['title', 'breadcrumbs' => []])

<div class="row mb-4">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title mb-2">{{ $title }}</h4>
            @if(count($breadcrumbs) > 0)
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        @foreach($breadcrumbs as $crumb)
                            <li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">
                                @if($loop->last)
                                    {{ $crumb['label'] }}
                                @else
                                    <a href="{{ $crumb['url'] }}">{{ $crumb['label'] }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </nav>
            @endif
        </div>
    </div>
</div>
