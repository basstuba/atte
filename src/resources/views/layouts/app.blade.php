<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
    @yield('css')
</head>
<body>
    <header>
        <div class="header">
            <div class="header-title">
                <h1 class="header-title__logo">Atte</h1>
            </div>
            <div class="header-yield">
                @yield('nav')
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="footer">
            <div class="footer-title">
                <small class="footer-title__logo">Atte,inc.</small>
            </div>
        </div>
    </footer>
</body>
</html>