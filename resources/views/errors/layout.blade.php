<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="//fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    @vite('resources/assets/css/error-pages/layout.css')
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div class="title">
            @yield('message')
        </div>
    </div>
</div>
</body>
</html>
