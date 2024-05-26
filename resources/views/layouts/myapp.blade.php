<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v6.4.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/my.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    @yield('header_js')
</head>
<body>
    @csrf 
    <!-- ヘッダー -->
    <header class="container" style="font-size: 1.2em; padding: 10px;">
        <div id="logo" class="container" style="margin: 0 auto;"><a href="https://trade-information.org/Meigara"><img src="{{asset('assets/img/logo.png')}}" alt=""></a></div>
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-top: 10px;">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item {{ request()->routeIs('Meigara.show') ? 'active' : '' }}">
                        <a class="nav-link" href='{{ route('Meigara.show', ['meigara' => 5492]) }}'>アメリカ株</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('MeigaraCategory.index') ? 'active' : '' }}">
                        <a class="nav-link" href='{{ route('MeigaraCategory.index') }}'>銘柄カテゴリ一覧</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('Meigara.index') ? 'active' : '' }}">
                        <a class="nav-link" href='{{ route('Meigara.index') }}'>銘柄一覧</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('FX.index') ? 'active' : '' }}">
                        <a class="nav-link" href='{{ route('FX.index') }}'>FX通貨一覧</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('Tradingrules.show') ? 'active' : '' }}">
                        <a class="nav-link" href='{{ route('Tradingrules.show') }}'>市場取引ルール</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
 
    <!-- メインコンテンツ -->
    <main class="container">
        <h1>@yield('title')</h1>
        @if (session()->has("message"))
            <div class="alert alert-info">{{ session('message') }}</div>
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
    <footer class="footer mt-auto py-3 bg-light text-muted">
        <div class="container">
            <h5><a href="https://form.run/@yahoo-BFys9xGHNpYRBnbs0vzw" target="_blank" rel="noopener noreferrer">お問い合わせページ</a></h5>
            <h5><a href="{{ route('MeigaraCategory.privacypolicy') }}">プライバシーポリシー</a></h5>
            <h5><a href="{{ route('MeigaraCategory.disclaimer') }}">免責事項</a></h5>
            &copy;kamiyuki &copy;IEX Cloud  &copy;Google &copy;CurrencyApi
        </div>
    </footer>
    
   <!-- admax -->
   <script src="https://adm.shinobi.jp/s/f2dddc0e4239e2d98a8918c7a271e470"></script>
   <!-- admax -->
</body>
</html>