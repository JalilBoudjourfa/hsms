<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <!-- Styles -->
    <!-- Scripts -->
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    {{-- <link rel="stylesheet" href="{{asset('build/assets/app.1e9c1961.js')}}">
    <link rel="stylesheet" href="{{asset('build/assets/app.9ceb7c54.css')}}"> --}}
    @livewireStyles
    @livewireScripts
    @stack('scripts')
</head>

<body class="antialiased flex h-screen">

    <x-side-bar />

    {{-- Page Content --}}
    <section id="main" class="bg-gray-200 flex-1 max-h-full overflow-auto ">

        <header class="flex h-12 bg-white shadow items-center">
            <div x-data="{ visible: false }" x-show="visible" x-transition
                x-on:click="$dispatch('open-sidebar'); visible = false" x-on:close-sidebar.window="visible = true"
                class="h-8 aspect-square bg-gray-800 text-white rounded-r-full pointer cursor-pointer hover:bg-gray-900">
                <x-icons2.chevron-double-right />
            </div>

            <h2 class="px-4 font-semibold text-xl text-gray-800 leading-tight flex items-center  w-full">
                {{ $header }}
            </h2>
        </header>

        <main class="p-4 flex justify-center md:py-8 md:px-6">
            <div class="container p-4 rounded-lg md:p-6">
                {{ $slot }}

                @livewire('notifications')
            </div>
        </main>

    </section>

    <footer
        class="absolute bottom-0 right-0 z-10 bg-gray-400 bg-opacity-80 text-gray-100 py-1 px-4 rounded-tl-xl text-xs text-right">
        &copy;2022 <span class="font-bold"> Elhayat school</span>
    </footer>

</body>

</html>
