<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title> Title </title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body>
        <div id="app">
            @include('include.nav')
            <div class="container-fluid">
                <div class="row mt-2">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>

</html>