@extends('layouts.myapp')
@section('title','FX通貨一覧')
@section('content')
<h2>FXリアルタイムレート</h2>
<table class="fx_rate">
    <tr>
        <th>国旗</th>
        <th>通貨ペア</th>
        <th>更新前</th>
        <th>更新後</th>
        <th>変動</th>
        <th>更新時間</th>
        <th>変動幅</th>
    </tr>
    <tr>
        <td id="USDCAD_country"></td>
        <td id="USDCAD_currency_pairs"></td>
        <td id="USDCAD_before_value"></td>
        <td id="USDCAD_after_value"></td>
        <td id="USDCAD_fluctuation"></td>
        <td id="USDCAD_timestamp"></td>
        <td id="USDCAD_variation"></td>
    </tr>
    <tr>
        <td id="USDGBP_country"></td>
        <td id="USDGBP_currency_pairs"></td>
        <td id="USDGBP_before_value"></td>
        <td id="USDGBP_after_value"></td>
        <td id="USDGBP_fluctuation"></td>
        <td id="USDGBP_timestamp"></td>
        <td id="USDGBP_variation"></td>
    </tr>
    <tr>
        <td id="USDJPY_country"></td>
        <td id="USDJPY_currency_pairs"></td>
        <td id="USDJPY_before_value"></td>
        <td id="USDJPY_after_value"></td>
        <td id="USDJPY_fluctuation"></td>
        <td id="USDJPY_timestamp"></td>
        <td id="USDJPY_variation"></td>
    </tr>
</table>
<script type="text/javascript">
    function fx_rate(){
        var symbol = "USDCAD,USDGBP,USDJPY";
        // console.log(symbol);
        var hostname = "{{ request()->getUriForPath('') }}";
        // console.log(hostname);
        var url = hostname + "/api/FX/rates?symbol=" + symbol;
        // console.log(url);
        var before_value = [];
        $.ajax({
            url: url,
            dataType: "json",
            cache: false,
            async: false,
            success: function(data, textStatus){
                // console.log(data);
                for(i = 0 ; i <data.length; i++){
                    // console.log(data[i].symbol);
                    var currency = data[i].symbol;
                    $('#'+ currency + "_country").text(data[i].symbol);
                    $('#'+ currency + "_currency_pairs").text(data[i].symbol);
                    if(sessionStorage.setItem('rate', data[i].rate) != ""){
                        $('#'+ currency + "_before_value").text(sessionStorage.getItem('rate'));
                    }else{
                        var rate = sessionStorage.setItem('rate', data[i].rate);
                        before_value.push(rate);
                        console.log(before_value);
                    }
                    $('#'+ currency + "_after_value").text(data[i].rate);
                    $('#'+ currency + "_fluctuation").text(data[i].rate);
                    $('#'+ currency + "_timestamp").text((new Date(data[0].timestamp)).toString());
                    $('#'+ currency + "_variation").text(data[i].rate);  
                    console.log(sessionStorage.getItem('rate'));
                }
            },
            error: function(xhr, textStatus, errorThrown){
                // エラー処理
                alert("通信エラーが発生しました。");
            }
        });

    }

    fx_rate();
</script>
@endsection