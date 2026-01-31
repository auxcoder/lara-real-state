@extends('frontend.layout.app')

@section('title', 'Real Estate Insights | The H Real Estate Blog')
@section('description', 'Stay updated with property news, investment tips, and market trends in UAE real estate. Expert insights from The H Real Estate team.')

@section('content')
    <style>
        .banners {
            /* set up the image + gradient together */
            background-image:
                /* top layer: 50%-black overlay */
                linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                /* bottom layer: your JPG */
                url("{{ asset('assets/images/about/blogs banner.jpg') }}");

            /* now separately declare how each layer behaves */
            background-repeat: no-repeat, no-repeat;
            background-position: center center, center center;
            background-size: cover, cover;

            height: 70vh;
            display: flex;
            align-items: center;
            text-align: center;
        }
    </style>
    <!-- Hero Banner Section -->
    <section class="py-5 text-white bg-primary banners">
        <div class="container">
            <div class="text-center">
                <h2 class="bannerh2">{{ __('Blogs') }}</h2>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <!-- Blog Grid -->
            <div class="row mb-5 g-4">
                @forelse ($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <article class="card border-0 shadow-sm h-100 hover-card">
                            <!-- Blog Image -->
                            <div class="position-relative overflow-hidden">
                                <img src="{{ $blog->image ? asset('storage/' . $blog->image) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}"
                                    alt="{{ $blog->translate()?->title }}" class="blog-image"
                                    style="height: 200px; object-fit: cover;" />
                                {{-- <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary rounded-pill">{{ __('Blogs') }}</span>
                                </div> --}}
                            </div>

                            <!-- Blog Content -->
                            <div class="d-flex flex-column card-body">
                                <div class="d-flex align-items-center mb-3 text-muted">
                                    <i class="fa-calendar-alt fas me-2"></i>
                                    <small>{{ $blog->created_at->format('F j, Y') }}</small>
                                </div>
                                <h3 class="mb-3 text-dark card-title fw-bold h5">
                                    <a href="{{ route('blog.show', $blog->slug) }}">
                                        {{ $blog->translate()?->title }}
                                    </a>
                                </h3>

                                <p class="flex-grow-1 mb-4 text-muted card-text">
                                    {{ Str::limit(strip_tags($blog->translate()?->description), 120) }}
                                </p>


                                <div class="mt-auto">
                                    <a href="{{ route('blog.show', $blog->slug) }}"
                                        class="btn-outline-primary btn-sm">
                                        {{ __('Read More') }}
                                        <i class="fa-arrow-right fas ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                @empty
                    <!-- Empty State -->
                    <div class="col-12">
                        <div class="py-5 text-center">
                            <div class="mx-auto card border-0 shadow-sm" style="max-width: 400px;">
                                <div class="p-5 card-body">
                                    <i class="mb-3 text-muted fa-3x fa-file-alt fas"></i>
                                    <h3 class="mb-3 text-dark fw-bold h4">{{ __('No blogs yet') }}</h3>
                                    <p class="text-muted">{{ __('Stay tuned') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($blogs->hasPages())
                <div class="d-flex justify-content-center">
                    <div class="pagination-wrapper">
                        {{ $blogs->links() }}
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .hover-card {
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .blog-image {
            transition: transform 0.3s ease;
        }

        .hover-card:hover .blog-image {
            transform: scale(1.05);
        }

        .card-title {
            transition: color 0.2s ease;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .hover-card:hover .card-title {
            color: var(--bs-primary) !important;
        }

        .card-text {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .btn-outline-primary {
            transition: all 0.2s ease;
        }

        .btn-outline-primary:hover {
            transform: translateX(2px);
        }

        .pagination-wrapper .pagination {
            gap: 0.25rem;
        }

        .pagination-wrapper .page-link {
            border-radius: 0.375rem;
            margin: 0 0.125rem;
            transition: all 0.2s ease;
        }

        .pagination-wrapper .page-link:hover {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
            color: white;
        }

        .pagination-wrapper .page-item.active .page-link {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
        }

        .pagination-wrapper .page-item.disabled .page-link {
            opacity: 0.5;
        }

        .banner {
            background: linear-gradient(135deg, var(--bs-primary), var(--bs-purple, #6f42c1));
        }
    </style>
@endpush
