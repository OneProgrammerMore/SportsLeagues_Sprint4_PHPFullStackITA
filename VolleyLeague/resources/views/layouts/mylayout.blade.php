<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>{{ config("app.name", "CupApp") }}</title>
        <link
            rel="icon"
            href="{{ Vite::asset("resources/img/cupLogo.png") }}"
        />
        <link rel="icon" href="{{ Vite::asset("resources/css/app.css") }}" />
        <link
            rel="stylesheet"
            href="{{ Vite::asset("resources/css/iconStyles.css") }}"
        />
    </head>

    <body>
        <x-web.header />

        <main>
            <!-- {{ $slot }} -->

            @yield("content")
            ;
        </main>

        <x-footer />
        @livewireScripts
    </body>
</html>
