<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Main')</title>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,300" rel="stylesheet" type="text/css">
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="wrapper">
    @include('partials.header')

    <main>
        <div class="menu-container">
            <div class="menu-toggle" onclick="toggleMenu()">
                <img class="open" src="{{ asset('icons/menu.svg') }}" alt="open menu">
                <img class="close" src="{{ asset('icons/menu.svg') }}" alt="close menu">
            </div>
            <div class="menu" id="menu">
                <div class="new-project">
                    <a href="#"><img src="{{ asset('icons/plus.svg') }}" alt="plus"></a>
                </div>
                <div class="link">
                    <a href="#"><img src="{{ asset('icons/star.svg') }}" alt="star"><p>Pipelines</p></a>
                </div>
                <div class="link">
                    <a href="{{ route('statistics') }}">
                        <img src="{{ asset('icons/settings.svg') }}" alt="settings">
                        <p>Statistics</p>
                    </a>
                </div>
                <div class="link">
                    <a href="#"><img src="{{ asset('icons/folder.svg') }}" alt="folder"><p>Projekti</p></a>
                </div>
            </div>
        </div>
        @yield('content')
    </main>

    @include('partials.footer')
</div>
</body>
</html>
