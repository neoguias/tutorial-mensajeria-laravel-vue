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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main id="app" class="flex grow w-full ">
                <aside id="sidebar" class="bg-gray-700 overflow-auto min-w-[250px]  table-cell">
                    <div class="items-center text-center">
                        <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline p-2 my-3 block">
                            {{ config('app.name', 'Mensajería') }}
                        </a>                   
                    </div>
                    <ul class="list-none text-lg text-white">
                        <li>
                            <router-link :to="{ name: 'messages.compose' }" class="block p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-current inline-block"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> 
                                Nuevo
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'messages' }" class="block p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-current inline-block"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                                Recibidos
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'messages.sent' }" class="block p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 0 24 24" fill="none" width="15" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-current inline-block"><path fill="none" d="M38 2v8h-26.34l7.17-7.17-2.83-2.83-12 12 12 12 2.83-2.83-7.17-7.17h30.34v-12z"/></svg>
                                Enviados
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'messages.archived' }" class="block p-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="stroke-current inline-block"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                Archivados
                            </router-link>
                        </li>
                    </ul>
                </aside>
                <div class="items-center w-full table-cell">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
