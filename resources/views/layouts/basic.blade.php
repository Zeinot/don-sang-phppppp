<!DOCTYPE html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{--    <meta name="application-name" content="{{ config('app.name') }}">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{asset('/storage/img/logo.png') }}" type="image/x-icon"/>
    <title>Blood Donation</title>

    @vite('resources/css/app.css')
    @filamentStyles
</head>
<body class="antialiased">

    <x-navbar/>
    @yield("body")
    <x-footer/>

{{--    SCRIPTS   --}}
    @livewire('notifications')
    @vite('resources/js/app.js')
    @filamentScripts
</body>
</html>
