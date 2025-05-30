<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main</title>
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
                    <a href="#">
                        <img src="{{ asset('icons/star.svg') }}" alt="star">
                        <p>Pipelines</p>
                    </a>
                </div>
                <div class="link">
                    <a href="#">
                        <img src="{{ asset('icons/settings.svg') }}" alt="settings">
                        <p>Logs</p>
                    </a>
                </div>
                <div class="link">
                    <a href="#">
                        <img src="{{ asset('icons/folder.svg') }}" alt="folder">
                        <p>Projekti</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="pipeline-container">
            <h2>Pipelines</h2>
            <div class="sort-buttons">
                <button><img src="{{ asset('icons/date.svg') }}" alt="date">Datums</button>
                <button>Statuss</button>
            </div>

            <div class="pipeline-list">
                <div class="table-header">
                    <div>Projekts</div>
                    <div>Zars</div>
                    <div>Statuss</div>
                    <div>Pipeline Info</div>
                </div>

                @foreach ($pipelines as $pipeline)
                    <div class="table-row">
                        <div>{{ $pipeline['project']['name'] ?? 'N/A' }}</div>
                        <div>{{ $pipeline['ref'] ?? 'N/A' }}</div>
                        <div>{{ ucfirst($pipeline['status']) }}</div>
                        <div><a href="{{ $pipeline['web_url'] }}">Link to pipeline</a></div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    @include('partials.footer')
</div>
</body>
</html>
