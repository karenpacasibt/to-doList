<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- esta es una manera de poner la refencia del css que utlizaremos para -->
        <!-- pero no es la mejor en todos lo casos, es lo incorrecto-->
        <!--<link rel="stylesheet" href="/app.css">-->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        {{$slot }}
    </body>
</html>