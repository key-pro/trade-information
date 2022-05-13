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
        <div id="logo"><img src="{{asset('assets/img/logo.png')}}" alt=""></div>
        
        <nav>
        <div class="hamburger-menu">
                <input type="checkbox" id="menu-check">
                <label for="menu-check" class="menu-btn"><span></span></label>
            <div class="menu-content">
                <ul>
                    <li class="{{ request()->routeIs('Meigara.show') ? 'active' : 'inactive' }}"><a href='{{ route('Meigara.show', ['meigara' => 5492]) }}'>アメリカ株</a></li>
                    <li class="{{ request()->routeIs('MeigaraCategory.index') ? 'active' : 'inactive' }}"><a href='{{ route('MeigaraCategory.index') }}'>銘柄カテゴリ一覧</a></li>
                    <li class="{{ request()->routeIs('Meigara.index') ? 'active' : 'inactive' }}"><a href='{{ route('Meigara.index') }}'>銘柄一覧</a></li>
                    <li class="{{ request()->routeIs('FX.index') ? 'active' : 'inactive' }}"><a href='{{ route('FX.index') }}'>FX通貨一覧</a></li>
                    <li class="{{ request()->routeIs('Tradingrules.show') ? 'active' : 'inactive' }}"><a href='{{ route('Tradingrules.show') }}'>市場取引ルール</a></li> 
                </ul>
            </div>
        </div>
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