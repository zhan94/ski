<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @vite('resources/css/styles.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>

<body style="font-family: 'Manrope',sans-serif; font-size: 20px">
    @if (Auth::check())
        <script>
            window.Laravel = {!!json_encode([
                'isLoggedin' => true,
                'user' => Auth::user()
            ])!!}
        </script>
    @else
        <script>
            window.Laravel = {!!json_encode([
                    'isLoggedin' => false
                ])!!}
        </script>
    @endif
    <div id="app"></div>
</body>
</html>
