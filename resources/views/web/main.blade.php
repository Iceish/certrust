<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ Cookie::get('theme') ?? 'light' }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Certrust - SSL made easy</title>
        @vite(['resources/styles/app.scss', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        @yield('body')

        <script src="{{ @asset('js/utils/cookie.js') }}"></script>
        <script src="{{ @asset('js/theme-switch.js') }}"></script>
        <script>

        </script>
        @stack('scripts')
    </body>
</html>
