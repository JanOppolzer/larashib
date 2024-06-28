<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} &dash; @yield('title')</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 dark:bg-gray-900 dark:text-gray-400 antialiased text-gray-700">

    @include('header')

    <main class="md:p-8 max-w-screen-xl p-4 mx-auto">

        <x-flash-message />

        @yield('content')

    </main>

    @include('footer')

</body>

</html>
