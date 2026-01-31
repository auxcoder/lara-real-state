@extends('frontend.layouts.app')

@section('content')
<div class="detail">
    <div class="row">
        <div class="col-md-12">
            <div class="le2">
                <h3>Overview</h3>
                <p>{{ $developer_property->description }}</p>
                <h3>Key Highlights:</h3>
                <ul>
                    @php
                        $keyHighlights = explode(',', $developer_property->key_highlights);
                    @endphp
                    @forelse ($keyHighlights as $key_highlight)
                        <li>
                            {{ $key_highlight }}
                        </li>
                    @empty
                        <li> No highlights available.</li>
                    @endforelse

                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
