<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>
        <link rel="icon" href="{{ Vite::asset("resources/img/cupLogo.png") }}">
        <link rel="stylesheet" href="{{ Vite::asset("resources/css/app.css") }}">
        <link rel="stylesheet" href="{{ Vite::asset("resources/css/iconStyles.css") }}" />
    
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- @include("layouts.navigation") -->
            @php
                $leagueId = $league->league_id;
            @endphp

            <x-web.header :leagueId="$leagueId" />

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>
        </div>
        <x-footer />
    </body>
</html>
