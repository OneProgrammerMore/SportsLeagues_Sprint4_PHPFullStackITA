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
        <link
            rel="stylesheet"
            href="{{ Vite::asset("resources/css/app.css") }}"
        />
        <link
            rel="stylesheet"
            href="{{ Vite::asset("resources/css/iconStyles.css") }}"
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
            @php
                echo $leagueId;
            @endphp

            <!-- Page Content -->
            <main>
                @yield("content")
            </main>

            <x-footer />

        </div>
    </body>
</html>
