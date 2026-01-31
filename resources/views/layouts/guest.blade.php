<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>

<!-- FIX: clear tailwinf classes -->
<body class="text-gray-900 antialiased font-sans">
    <div class="d-flex flex-column justify-content-center items-center pt-6 sm:pt-0 bg-light">
        <div>
            <a href="/">
                <x-application-logo class="text-muted w-20 h-20 fill-current" />
            </a>
        </div>

        <div class="mt-6 px-6 py-4 bg-white rounded-3 shadow-md w-100 overflow-hidden">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
