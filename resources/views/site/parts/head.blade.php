<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Required meta tags -->
    @if(isset($meta))
        <title>{{ isset($meta['title']) ? $meta['title'] : config('template_settings.site.title') }}</title>
        <meta name="keywords" content="{{ isset($meta['keywords']) ? $meta['keywords'] : config('template_settings.site.keywords') }}">
        <meta name="description" content="{{ isset($meta['description']) ? $meta['description'] : config('template_settings.site.description') }}">
    @endif

    <!-- Favicon -->
     <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">

    <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/basetemplate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">
    @yield('additional_styles')
</head>
