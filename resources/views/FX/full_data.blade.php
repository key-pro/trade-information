@extends('layouts.myapp')
@section('title','FX通貨一覧')
@section('content')
<div id="loader-bg" class="container">
    <div class="bouncingLoader"><div></div></div>
</div>
<h2 class="container">FXリアルタイムレート<br>
    <a class="fx_info" href="/FX">FX通貨一覧はこちら</a>
</h2>
<table class="fx_rate container" id="fx_rate_table">
    <tr>
        <th class="country">国旗</th>
        <th class="currency_pairs">通貨ペア</th>
        <th class="currency_value">現在レート</th>
    </tr>
</table>
<script>
var table_initialized = false;

function table_init(currency_pairs){
    if(table_initialized){
        return;
    }

    var row_src = '<tr>' +
    '<td class="flags" id="XXXYYY_country"><img src="XXX"><img src="YYY"></td>' +
    '<td id="XXXYYY_currency_pairs"></td>' +
    '<td id="XXXYYY_currency_value"></td>'
    '</tr>';
    for(i = 0; i < currency_pairs.length; i++){
        // for(j = 0; j < currency_pairs[i].length; j++){
            var pair = currency_pairs[i];
            var row = row_src.replaceAll("XXXYYY",pair);
            var flag1 = pair.substr(0,3);
            var flag2 = pair.substr(3,3);
            row = row.replaceAll("XXX","{{asset('assets/img/National_flags')}}/"+flag1+".png");
            row = row.replaceAll("YYY","{{asset('assets/img/National_flags')}}/"+flag2+".png");
            switch(pair){
                
            case 'BTCJPY':
                break;
            case 'BCHJPY':
                break; 
            case 'BTGJPY':
                break;
            case 'DASHJPY':
                break;
            case 'EOSJPY':
                break;
            case 'ETHJPY':
                break;
            case 'JPYJPY':
                break;
            case 'LTCJPY':
                break;
            case 'XAGJPY':
                break;
            case 'XAUJPY':
                break;
            case 'XLMJPY':
                break;
            case 'XRPJPY':
                break;
            case 'XOFJPY':
                break;    
            default:
                $("#fx_rate_table").append(row);
            }
    }
    table_initialized = true;
}

function my_round(value,pos){
    return Math.round(value * (10 ** pos))/(10 ** pos);
}

function fx_rate(){
    var hostname = "{{ request()->getUriForPath('') }}";
    var url = hostname + "/api/FX/Full_var";
    var before_value = [];
    $.ajax({
        url: url,
        dataType: "json",
        cache: false,
        async: false,
        success: function(data, textStatus){
            table_init(data["currency_pairs"]);
            for(i = 0 ; i <data.fx_rate.length; i++){
                var currency = data.fx_rate[i].symbol;
                var flag1 = currency.substr(0,3);
                var flag2 = currency.substr(3,3);
                $('#'+ currency + "_currency_pairs").text(data.fx_rate[i].symbol);
                $('#'+ currency + "_currency_value").text(my_round((1 / data.fx_rate[i].rate),3));
            }
        },
        error: function(xhr, textStatus, errorThrown){
            // エラー処理
            alert("通信エラーが発生しました。");
        }
    });
}

function fx_rate_all(){
        fx_rate();
        setTimeout(fx_rate_all,60000);
}
// table_init();
fx_rate_all();
// setInterval(fx_rate_all,10000);
$(window).on('load',function(){
    $("#loader-bg").delay(100).fadeOut('slow');
    //ローディング画面を3秒（3000ms）待機してからフェードアウト
});
</script>
@endsection