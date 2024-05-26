@extends('layouts.myapp')
@section('title','FX通貨一覧')
@section('content')
<div id="loader-bg" class="container">
    <div class="bouncingLoader"><div></div></div>
</div>
<h2 class="container">FXリアルタイムレートレート<br>
    <a class="fx_info" href="/FX/Full_var">FX通貨一覧はこちら</a>
</h2>
<table class="fx_rate container" id="fx_rate_table">
    <thead>
        <tr>
            <th class="country">国旗</th>
            <th class="currency_pairs">通貨ペア</th>
            <th class="currency_value">レート</th>
        </tr>
    </thead>
    <tbody id="fx_rate_body">
    </tbody>
</table>
<script type="text/javascript">

     // 通貨リスト
     const currency_list = [
                    "AED", "AFN", "ALL", "AMD", "ANG", "AOA", "ARS", "AUD", "AWG", "AZN", "BAM",
                    "BBD", "BDT", "BGN", "BHD", "BIF", "BMD", "BND", "BOB", "BRL", "BSD", "BTN",
                    "BWP", "BYN", "BZD", "CAD", "CDF", "CHF", "CLF", "CLP", "CNH", "CNY", "COP",
                    "CRC", "CUC", "CUP", "CVE", "CZK", "DJF", "DKK", "DOP", "DZD", "EGP", "ERN",
                    "ETB", "EUR", "FJD", "FKP", "GBP", "GEL", "GGP", "GHS", "GIP", "GMD", "GNF",
                    "GTQ", "GYD", "HKD", "HNL", "HRK", "HTG", "HUF", "IDR", "ILS", "IMP", "INR",
                    "IQD", "IRR", "ISK", "JEP", "JMD", "JOD", "KES", "KGS", "KHR", "KMF", "KPW",
                    "KRW", "KWD", "KYD", "KZT", "LAK", "LBP", "LKR", "LRD", "LSL", "LYD", "MAD",
                    "MDL", "MGA", "MKD", "MMK", "MNT", "MOP", "MRU", "MUR", "MVR", "MWK", "MXN",
                    "MYR", "MZN", "NAD", "NGN", "NIO", "NOK", "NPR", "NZD", "OMR", "PAB", "PEN",
                    "PGK", "PHP", "PKR", "PLN", "PYG", "QAR", "RON", "RSD", "RUB", "RWF", "SAR",
                    "SBD", "SCR", "SDG", "SEK", "SGD", "SHP", "SLL", "SOS", "SRD", "SSP", "STD",
                    "STN", "SVC", "SYP", "SZL", "THB", "TJS", "TMT", "TND", "TOP", "TRY", "TTD",
                    "TWD", "TZS", "UAH", "UGX", "USD", "UYU", "UZS", "VES", "VND", "VUV", "WST",
                    "XAF", "XOF", "XPF", "YER", "ZAR", "ZMW", "ZWL"
    ];

    $(document).ready(function(){
    fx_rate(); // fx_rate()関数をページが読み込まれた後に呼び出す
});

function table_init(){
    //テーブル　tdの定義
    var row_src = '<tr class="TR-CLASS">' +
    '<td class="flags" id="XXXYYY_country"><img src="XXX"><img src="YYY"></td>' +
    '<td id="XXXYYY_currency_pairs"></td>' +
    '<td id="XXXYYY_currency_value"></td>' + 
    '</tr>';

    //通貨ペアごとtdタグに値を追加する
    for(i = 0; i < currency_list.length; i++){
        //通貨名取得
        var pair = currency_list[i];
        //通貨名にtdタグのid付与
        var row = row_src.replaceAll("XXXYYY",pair);
        //通貨名取り出す
        var flag1 = pair.substr(0,3);
        //日本の通貨定義
        var flag2 = "JPY";
        //通貨の国旗画像取得
        row = row.replaceAll("XXX","https://trade-information.org/assets/img/National_flags/"+flag1+".png");
        row = row.replaceAll("YYY","https://trade-information.org/assets/img/National_flags/"+flag2+".png");
        // テーブルに行を追加
        $("#fx_rate_table").append(row);
    }
}
table_init();
function fx_rate(){
    // 現在のリクエストのホスト名を取得する
    var hostname = "{{ request()->getUriForPath('') }}";
    // APIエンドポイントへの完全なURLを生成する
    var url = hostname + "/api/FX/fx_open";

    // fetchを使用してAPIにリクエストを送信し、JSONレスポンスを取得
    fetch(url)
        // JSONレスポンスを取得
        .then(response => response.json())
        .then(data => {
            // レートデータを取得
            const rates = data.rates;
            // 通貨リストをループして各通貨のレートを取得し、テーブルに表示する
            currency_list.forEach(currency => {
                // 通貨がレートデータに存在するかを確認する
                if (currency in rates) {
                    // USDベースのレートをJPYベースのレートに変換
                    var rate = rates['JPY'] / rates[currency]; 
                    // 通貨コードを取得し、国旗のファイル名として使用する
                    var flag1 = currency;
                    //日本の通貨コード定義
                    var flag2 = "JPY";
                    // 通貨コードを使用して、国旗の画像のURL指定
                    var img1 = "<img src='https://trade-information.org/assets/img/National_flags/"+flag1+".png'>";
                    var img2 = "<img src='https://trade-information.org/assets/img/National_flags/"+flag2+".png'>";
                    // 通貨ペアの識別子を作成する
                    var currencyPairId = currency + "JPY";
                    // 通貨ペアの表示領域のセレクターを作成する
                    var currencyPairSelector = "#" + flag1 + "_currency_pairs";
                    // 通貨のレート表示領域のセレクターを作成する
                    var rateSelector = "#" + flag1 + "_currency_value";
                    // 通貨ペアを表示する要素に通貨ペアの識別子をテキストとして設定する
                    $(currencyPairSelector).text(currencyPairId);
                    // 対象通貨の現在のレートを表示する　小数点第３まで表示
                    $(rateSelector).text(rate.toFixed(3));
                }
            });
        })
    //API取得得たー表示エラー表示
    .catch(error => console.error('Error fetching data:', error)); 
}

//ページロード画面生成
$(window).on('load',function(){
    $("#loader-bg").delay(100).fadeOut('slow');
});
</script>
@endsection
