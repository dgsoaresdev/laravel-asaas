<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>@yield('title-page')</title>
        <meta charset="utf-8">
        
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" type="text/javascript"></script>
        <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/jquery.mask.js') }}"></script>

    </head>

    <body class="pb-5">
        @yield('body')
    </body>
</html>