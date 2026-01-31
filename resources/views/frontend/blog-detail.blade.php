@extends('frontend.layout.app')
@section('title', $blog->translate()?->title . ' | Blog {{ config('company.name') }}')
@section('description', \Illuminate\Support\Str::limit(strip_tags($blog->translate()?->description), 160))
@section('content')
    {{-- <section class="blog-banner">
        <div class="container">
            <h2 class="bannerh2">{{ $blog->translate()?->title }}</h2>
        </div>
    </section> --}}

    <section>
        <div class="container">
            <div class="blog-inner">
                <div class="row">
                    <div class="col-lg-9 col-md-12 p-5">
                        <div class="blog-text">
                              <img src="{{ $blog->image ? asset('storage/' . $blog->image) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}"

                                class="blog-image"
                                alt="{{ $blog->translate()?->title }}" />

                            <h4 class="blog-a1">{{ $blog->created_at->format('F d, Y') }}</h4>

                            <h3 class="blog-a2">{{ $blog->translate()?->title }}</h3>

                            {!! $blog->translate()?->description !!}
                        </div>
                    </div>

                    {{-- Optional Sidebar for Related Blogs --}}
                    {{--
                    <div class="col-md-3">
                        <div class="border-left">
                            @foreach ($blogs as $related)
                                <div class="blog-sidebar">
                                    <img src="{{ $related->image ? asset('storage/' . $related->image) : asset('images/default-blog.jpg') }}"
                                        class="blogside-img" />
                                    <h4 class="sidebar-a1">
                                        {{ \Illuminate\Support\Str::limit($related->translate()?->title, 50) }}
                                    </h4>
                                    <a href="{{ route('blog.show', $related->translate()?->slug) }}" class="sidebar-btn">
                                        {{ __('Read More') }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    --}}
                </div>
            </div>

            <!-- Newsletter -->
            <div class="about-3">
                <div class="container">
                    <h3 class="about3a">{{ __('Be the first to know.') }}</h3>
                    <p class="about3b">
                        {{ __('We invite you to register below and we’ll be in touch with exclusive updates and announcements about pre-leasing opportunities.') }}
                    </p>
                    <form method="POST" action="#">
                        @csrf
                        <input type="email" placeholder="{{ __('notify.email_placeholder') }}" name="email" required />
                        <button type="submit"><i class="fa-paper-plane fa-solid"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
