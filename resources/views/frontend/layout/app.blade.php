<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" translate="no">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', config('company.name') . ' | ' . config('company.tagline'))</title>
    <meta name="title" content="@yield('title', config('company.name') . ' | ' . config('company.tagline'))">
    <meta name="description"
        content="@yield('description', 'Empresa inmobiliaria de confianza en ' . config('company.country') . ' ofreciendo soluciones expertas en propiedades. Encuentra viviendas de lujo o asequibles adaptadas a tus necesidades.')">
    <meta name="keywords" content="" />
    {{-- @if (app()->getLocale() == "ar") --}}
    {{-- <meta name="direction" content="rtl"> --}}
    {{-- @endif --}}
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-NHSHZHZEWD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-NHSHZHZEWD');
    </script>
    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo-countryside-fav.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    {{-- @if (app()->getLocale() == 'ar') --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet"> --}}
    {{-- @else --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- @endif --}}

    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <!-- Include Summernote CSS -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet"> --}}
    @stack('styles')

</head>

<body>

    @include('frontend.layout.header')

    <!-- Toast Container -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        @if (session('success'))
            <x-toast type="success" :message="session('success')" />
        @endif
        @if (session('error'))
            <x-toast type="danger" :message="session('error')" />
        @endif
        @if (session('info'))
            <x-toast type="info" :message="session('info')" />
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <x-toast type="danger" :message="$error" />
            @endforeach
        @endif
    </div>

    @yield('content')

    @include('frontend.layout.footer')

</body>

@stack('scripts')

</html>
