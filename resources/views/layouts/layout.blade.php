<!doctype html>
<html lang="en" style="min-height:100vh">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>

        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
{{--        <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet"--}}
{{--              integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">--}}

    </head>
    <body>
        <header>
            @include('partials.header')
        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            @include('partials.footer')
        </footer>
{{--        <script src="https://getbootstrap.com/docs/5.3/dist/js/bootstrap.bundle.min.js"--}}
{{--            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"--}}
{{--            crossorigin="anonymous"></script>--}}
    </body>
</html>
