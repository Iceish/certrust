<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ Cookie::get('theme') ?? 'light' }}" >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Certrust - SSL made easy</title>
        @vite(['resources/styles/app.scss', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.min.css">
    </head>
    <body>
        @yield('body')

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js"></script>
        <script src="{{ @asset('js/utils/cookie.js') }}"></script>
        <script src="{{ @asset('js/theme-switch.js') }}"></script>
        <script src="{{ @asset('js/swal.js') }}"></script>

        @if($errors->any())
            <script>
                Toast.fire({icon: 'error',title: '{{ implode('\n', $errors->all()) }}'});
            </script>
        @endif
        @if(!empty(session('success')))
            <script>
                Toast.fire({icon: 'success',title: '{{ session('success') }}' });
            </script>
        @endif

        @stack('scripts')
    </body>
</html>
