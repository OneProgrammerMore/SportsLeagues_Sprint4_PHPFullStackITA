<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link href="{{ URL::asset("css/app.css") }}" rel="stylesheet" />
        <title>CupApp</title>
        @vite("resources/css/app.css")
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
        @livewireStyles
    </head>

    <body>
        <x-web.header />

        <main>
            {{ $slot }}
        </main>

        <x-footer />
        @livewireScripts
    </body>
</html>
