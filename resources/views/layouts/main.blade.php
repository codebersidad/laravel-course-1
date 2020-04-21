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

        @if(isset($editor))
            <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
            <script>
                setTimeout(function() {
                    bsCustomFileInput.init();
                    CKEDITOR.replace ('FormControlText' );
                },300);
            </script>
        @endif
    </body>

</html>