<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/my.css')}}">
    <script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous">
    </script>
    @yield('header_js')

</head>
<body>
       
    <!-- ヘッダー -->
    <header>
        tradeインフォメーション
        <nav>
            <ul>
                <li><a href='/Meigara/5492/show'>アメリカ株一覧</a></li>
                <li><a href='/Meigara'>銘柄カテゴリ</a></li>
                <li><a href='/FX'>FX通貨一覧</a></li>
                <li><a href='/Tradingrules'>市場取引ルール</a></li>
                <li><a href=”#”>Blog</a></li>
                <input id="btn-mode" type="checkbox"> ダークモード    
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
 
    <!-- フッター -->
    <footer>
        &copy;kamiyuki
    </footer>
 
   
    <!-- <script src="sample.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script>
        // チェックボックスの取得
        const btn = document.querySelector("#btn-mode");

        // チェックした時の挙動
        btn.addEventListener("change", () => {
        if (btn.checked == true) {
            // ダークモード
            document.body.classList.remove("light-theme");
            document.body.classList.add("dark-theme");
        } else {
            // ライトモード
            document.body.classList.remove("dark-theme");
            document.body.classList.add("light-theme");
        }
        });
    </script>
</body>
</html>