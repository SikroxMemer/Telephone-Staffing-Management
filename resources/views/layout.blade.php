<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Page Title' }}</title>
        <link rel="shortcut icon" href="" type="image/x-icon">
        @vite('resources/css/app.css')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/datepicker.min.js"></script>
        
    </head>
    <body>
        @include('components.sidebar')
        @yield('components.dashboard')
        @yield('affectation')
        @yield('puce')
        @yield('dotation')
    </body>
</html>
