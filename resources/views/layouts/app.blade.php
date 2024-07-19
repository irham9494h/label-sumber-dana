<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <wireui:scripts />
</head>

<body class="font-sans antialiased bg-gray-100 text-slate-900" x-cloak x-data="{ darkMode: $persist(false) }"
    :class="{ 'dark': darkMode === true }">
    <x-notifications z-index="z-[100]" position="top-right" />
    <x-dialog z-index="z-[100]" blur="sm" align="center" />

    <x-layouts.navbar />
    <x-layouts.sidebar.index />

    <div x-data class="min-h-screen pt-16 transition-all duration-200" :class="[
            $store.menu.isSidebarCollapse && 'pl-0 lg:pl-16',
            !$store.menu.isSidebarCollapse && 'pl-0 lg:pl-64'
        ]">
        <div class="w-full">
            @stack('header')
            <main class="w-full px-4 py-5 mx-auto container sm:px-6 lg:px-8">
                {{ $slot }}

            </main>
        </div>
    </div>

    @livewireScripts

    @stack('scripts')
</body>

</html>