<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>
        <link
            rel="icon"
            href="{{ Vite::asset("resources/img/cupLogo.png") }}"
        />
        {{--
        <link
            rel="stylesheet"
            href="{{ Vite::asset("resources/css/app.css") }}"
        /> --}}
        <link
            rel="stylesheet"
            href="{{ Vite::asset("resources/css/iconStyles.css") }}"
        />
        <link
            rel="stylesheet"
            href="{{ Vite::asset("resources/css/app.css") }}"
        />
        {{--
        <script src="{{ Vite::asset("resources/js/menu-responsive.js") }}"></script>
        <script src="{{ Vite::asset("resources/js/index_matches.js") }}"></script> --}}
        @vite("resources/js/index_matches.js")
        @vite("resources/js/menu-responsive.js")


        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet"
        />
    </head>

    <body class="font-sans antialiased">
        <div class="main-container">
            {{-- @include("layouts.navigation") --}}
            @php
                $leagueId = ! isset($leagues) && isset($league->league_id) && $league->league_id !== null ? $league->league_id : "";
            @endphp

            @if (empty($leagueId))
                <x-web.header-home />
            @else
                <x-web.header :leagueId="$leagueId" />
            @endif

            <!-- Page Content -->
            <main>
                @yield("content")
            </main>

            <x-footer />
        </div>
    </body>
</html>
