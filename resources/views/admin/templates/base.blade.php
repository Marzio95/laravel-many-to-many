<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>@yield('pageTitle')</title>
</head>

<body onclick="event.stopPropagation()" class="body">

    @include('admin.partials.header')

    @yield('pageMain')

    @include('admin.partials.footer')

</body>

</html>
