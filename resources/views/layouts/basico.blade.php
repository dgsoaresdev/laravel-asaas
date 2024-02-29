<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('title-page')</title>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        
        {{-- <link rel="stylesheet" href="https://29d2-2804-248-f9bf-b600-30dd-bd04-9999-17d9.ngrok-free.app/css/app.css" />
        <script src="https://29d2-2804-248-f9bf-b600-30dd-bd04-9999-17d9.ngrok-free.app/js/app.js" type="text/javascript"></script> --}}

    </head>

    <body class="pb-5">
        @yield('body')
    </body>
</html>