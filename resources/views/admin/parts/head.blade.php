<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('/img/favicon.png') }}"/>
  {{-- Meta --}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    @if(isset($meta))
          <title>{{ $meta['title'] }}</title>
          <meta name="keywords" content="{{ isset($meta['keywords']) ? $meta['keywords'] : '' }}">
          <meta name="description" content="{{ isset($meta['description']) ? $meta['description'] : '' }}">
    @endif

      <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
      <link rel="stylesheet" href="{{ asset('css/custom_admin.css') }}">
      @yield('additional_styles')

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
