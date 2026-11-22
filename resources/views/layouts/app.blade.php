<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>{{ $title ?? config('app.name') }}</title>

    @fonts
    @vite (['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-screen bg-slate-100 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Kolom Kiri: Form Create User -->
        <div class="lg:col-span-5 w-full">
            <livewire:users />
        </div>

        <!-- Kolom Kanan: Daftar User -->
        <div class="lg:col-span-7 w-full">
            <livewire:user-list />
        </div>
    </div>

    @livewireScripts
</body>
</html>
