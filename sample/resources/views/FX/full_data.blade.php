@extends('layouts.myapp')
@section('title','FX通貨一覧')
@section('content')
<h2>FXリアルタイムレート</h2>
<table class="fx_rate" id="fx_rate_table">
    <tr>
        <th class="country">国旗</th>
        <th class="currency_pairs">通貨ペア</th>
        <th class="before_value">更新前</th>
        <th class="after_value">更新後</th>
        <th class="fluctuation">変動</th>
        <th class="updown">変化↑↓</th>
        <th class="timestamp">更新時間</th>
        <th class="variation">変動幅</th>
    </tr>
</table>
<script>
var table_initialized = false;

function table_init(currency_pairs){
    if(table_initialized){
        return;
    }

    var row_src = '<tr>' +
    // '<td class="flags" id="XXXYYY_country"><img src="XXX"><img src="YYY"></td>' +
    '<td id="XXXYYY_currency_pairs"></td>' +
    '<td id="XXXYYY_before_value"></td>' +
    '<td id="XXXYYY_after_value"></td>' +
    '<td id="XXXYYY_fluctuation"></td>' +
    '<td id="XXXYYY_updown"></td>' +
    '<td id="XXXYYY_timestamp"></td>' +
    '<td id="XXXYYY_variation"></td>' +
    '</tr>';
    for(i = 0; i < currency_pairs.length; i++){
        // for(j = 0; j < currency_pairs[i].length; j++){
            var pair = currency_pairs[i];
            var row = row_src.replaceAll("XXXYYY",pair);
            var flag1 = pair.substr(0,3);
            var flag2 = pair.substr(3,3);
            //<link rel="stylesheet" href="{{asset('assets/css/my.css')}}">
            // row = row.replaceAll("XXX","{{asset('assets/img/National_flags')}}/"+flag1+".png");
            // row = row.replaceAll("YYY","{{asset('assets/img/National_flags')}}/"+flag2+".png");

            $("#fx_rate_table").append(row);
        // }
    }
    table_initialized = true;
}

function my_round(value,pos){
    return Math.round(value * (10 ** pos))/(10 ** pos);
}

function fx_rate(){
    // console.log(symbol);
    var hostname = "{{ request()->getUriForPath('') }}";
    // console.log(hostname);
    var url = hostname + "/api/FX/Full_var";
    // alert(url);
    // console.log(url);
    var before_value = [];
    // console.log(symbol);
    // return;
    $.ajax({
        url: url,
        dataType: "json",
        cache: false,
        async: false,
        success: function(data, textStatus){
            table_init(data["currency_pairs"]);
            // console.log(data);
            for(i = 0 ; i <data.length; i++){
                // console.log(data["rate"][i].symbol);
                var currency = data["rate"][i].symbol;
                // if(currency != "USDCAD" && currency != "USDJPY"){
                    // console.log(currency);
                // }
                /*
                var row = row_src.replaceAll("XXXYYY",pair);
                var flag1 = pair.substr(0,3);
                var flag2 = pair.substr(3,3);
                //<link rel="stylesheet" href="{{asset('assets/css/my.css')}}">
                row = row.replaceAll("XXX","{{asset('assets/img/National_flags')}}/"+flag1+".png");
                row = row.replaceAll("YYY","{{asset('assets/img/National_flags')}}/"+flag2+".png");
                */
                var flag1 = currency.substr(0,3);
                var flag2 = currency.substr(3,3);
                // var img1 = "<img src='{{asset('assets/img/National_flags')}}/"+flag1+".png'>";
                // var img2 = "<img src='{{asset('assets/img/National_flags')}}/"+flag2+".png'>";
                // $('#'+ currency + "_country").html(img1+img2);
                $('#'+ currency + "_currency_pairs").text(data["rate"][i].symbol);
                $('#'+ currency + "_before_value").text($('#'+ currency + "_after_value").text());
                $('#'+ currency + "_after_value").text(my_round(data["rate"][i].rate,5));
                var value = $('#'+ currency + "_after_value").text() - $('#'+ currency + "_before_value").text();
                var val2 = my_round(value,4);
                $('#'+ currency + "_fluctuation").text(val2);
                if(val2 == 0){
                    $('#'+ currency + "_updown").text("-");
                    $('#'+ currency + "_updown").css("background-color","white");
                }else if(val2 > 0){
                    $('#'+ currency + "_updown").text("↑");
                    $('#'+ currency + "_updown").css("background-color","#ffcccc");
                }else{
                    $('#'+ currency + "_updown").text("↓");
                    $('#'+ currency + "_updown").css("background-color","#ccccff");
                }

                // if(currency == "USDAED"){
                //             console.log(currency);
                // }

                $('#'+ currency + "_timestamp").text((new Date(data["rate"][0].timestamp)).toString().substr(16,8));
                var before_value = $('#'+ currency + "_before_value").text();
                if(before_value && before_value != "0"){
                    var ave = ($('#'+ currency + "_after_value").text() / $('#'+ currency + "_before_value").text());
                    try{
                        // console.log(ave);
                        if(ave){
                            if(("" + ave).indexOf("0.00")){
                                ave = my_round(ave,5);
                            }else if(("" + ave).indexOf("0.0")){
                                ave = my_round(ave,4);
                            }else if(("" + ave).indexOf("0.")){
                                ave = my_round(ave,3);
                            }else{
                                ave = my_round(ave,6)
                            }
                        }
                        if(("" + ave).length >= 10){
                            // console.log(ave);
                        }
                        $('#'+ currency + "_variation").text(ave  + "%");
                    }catch(e){
                        // console.log(e.getMessage());
                    }
                }else{
                    $('#'+ currency + "_variation").text("-");
                }
            }
        },
        error: function(xhr, textStatus, errorThrown){
            // エラー処理
            alert("通信エラーが発生しました。");
        }
    });
}

function fx_rate_all(){
    // for(i= 0; i < currency_pairs.length; i++){
        fx_rate();
        setTimeout(fx_rate_all,1000);
    // }
}
// table_init();
fx_rate_all();
// setInterval(fx_rate_all,10000);
</script>
@endsection