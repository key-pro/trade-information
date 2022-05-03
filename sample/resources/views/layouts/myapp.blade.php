<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/my.css')}}">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous">
    </script>
    @yield('header_js')

</head>
<body>
       
    <!-- ヘッダー -->
    <header>
        tradeインフォメーション
        <nav>
            <ul>
                <li><a href='/Meigara/5492/show'>アメリカ株</a></li>
                <li><a href='/MeigaraCategorys'>銘柄カテゴリ一覧</a></li>
                <li><a href='/Meigara'>銘柄一覧</a></li>
                <li><a href='/FX'>FX通貨一覧</a></li>
                <li><a href='/Tradingrules'>市場取引ルール</a></li> 
            </ul>
        </nav>
    </header>
 
    <!-- メインコンテンツ -->
    <main>
        <h1>@yield('title')</h1>
        @if (session()->has("message"))
            {{ session('message') }}
        @endif
        @yield('content')
    </main>

    <!-- ページトップへ戻るボタン -->
    <p class="pagetop" style="display: block;">
        <a href="#">
            <i class="fas fa-chevron-up"></i>
        </a>
    </p>

    <!-- フッター -->
    <footer>
        &copy;kamiyuki &copy;IEX Cloud Services LLC. &copy;Google
    </footer>
</body>
</html>