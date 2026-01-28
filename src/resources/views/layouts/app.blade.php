<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>体重管理アプリ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body class="app-bg @yield('body_class')">
    <main class="app-main">
        <div class="app-container">
            @yield('content')
        </div>
    </main>

    @yield('scripts')
</body>
</html>