<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name') }}</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <livewire:styles />
</head>
<body class="antialiased">

<div class="mx-auto my-16">
    @yield('content')
  </div>

  <livewire:scripts />
</body>
</html>
