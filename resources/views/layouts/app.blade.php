<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name') }}</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

  <livewire:styles />
</head>
<body class="min-h-full bg-fixed bg-cover bg-center  antialiased" style="background-image: url('assets/img/bg-mask.svg')">

  @include('partials.header')

  <div class="mx-16 my-8">
    @yield('content')
  </div>

  <livewire:scripts />
</body>
</html>
