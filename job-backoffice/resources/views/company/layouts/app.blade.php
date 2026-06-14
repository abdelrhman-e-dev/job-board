<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ config('app.name') }} - @yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/company/main.css') }}">
</head>

<body class="bg-background text-on-surface">
    {{-- SideNavBar --}}
    @include('company.layouts.partials.sidebar')
    {{-- Header --}}
    @include('company.layouts.partials.header')
    <main id="main-content" class="ml-[240px] pt-[64px] mt-6 p-lg min-h-screen">
        @yield('content')
    </main>
    <x-toaster-hub />
    <script src="{{ asset('js/company/main.js') }}"></script>
</body>

</html>
