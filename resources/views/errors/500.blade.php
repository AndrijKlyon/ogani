<html lang="ru">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" href="{{ asset('/img/favicon.png') }}">

    <!-- style CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/basetemplate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="d-flex justify-content-center align-items-center">
<div class="container text-center w-100">
    <div class="row">
        <div class="col-sm-12" style="color:#7fad39; font-size:200px;">
            500
        </div>
    </div>
    <div class="row pb-5">
        <div class="col-sm-12">
            К сожалению, при обработке запроса произошла ошибка на сервере.
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <a class="site-btn login-btn" href="{{ route('home') }}">Перейти на Главную</a>
        </div>
    </div>
</div>

</body>
</html>
