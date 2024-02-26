<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('title-page')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    </head>

    <body>
        @yield('body')
    </body>
</html>