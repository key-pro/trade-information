@extends('layouts.myapp')
@section('title')
{{
    $meigara -> meigara_name
}}株価詳細
@endsection
@section('header_js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
var candle_data = [];
/** 現在のDateオブジェクト作成 */
var d = new Date();
/** 文字列に日付をフォーマットする */
var formatted = `${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`.replace(/\n|\r/g, '');
var date = formatted;
$('#chart_date').val(date);

    function api_exchange(){
    var symbol = '{{ $meigara -> symbol }}';
    var hostname =  "{{ request()->getUriForPath('') }}";
    var url = hostname + "/api/Meigara/summary_data?symbol=" + symbol;
    // alert(url);
    $.ajax({
        url: url,
        dataType: "json",
        cache: false,
        success: function(data, textStatus){
        // 成功したとき
        // console.log(url);

        if(data[0].bidPrice == "0"){
            $('#bidPrice').text("取引時間外").css({"color":"red","font-weight":"bold"});
            $('#bidSize').text("取引時間外").css({"color":"red","font-weight":"bold"});
            $('#askPrice').text("取引時間外").css({"color":"red","font-weight":"bold"});
            $('#askSize').text("取引時間外").css({"color":"red","font-weight":"bold"});
        }else{
            $('#bidPrice').text(data[0].bidPrice);
            $('#bidSize').text(data[0].bidSize);
            $('#askPrice').text(data[0].askPrice);
            $('#askSize').text(data[0].askSize);
        }
        $('#lastUpdated').text((new Date(data[0].lastUpdated)).toUTCString());
        $('#lastSalePrice').text(data[0].lastSalePrice);
        $('#lastSaleSize').text(data[0].lastSaleSize);
        $('#lastSaleTime').text((new Date(data[0].lastSaleTime)).toUTCString());
        $('#volume').text(data[0].volume);

        // data にサーバーから返された html が入る
        },
        error: function(xhr, textStatus, errorThrown){
        // エラー処理
        alert("通信エラーが発生しました。");
        }
    });
    
}

api_exchange();

google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function chart_fetch_draw(date,chartInterval){
    var symbol = '{{ $meigara -> symbol }}';
    var hostname = "{{ request()->getUriForPath('') }}";
    // alert(hostname);
    var url = hostname + "/api/Meigara/chart_data?symbol=" + symbol + "&chartdate=" + date + "&chartInterval=" + chartInterval;
    // console.log(url);
    candle_data = [];
    $.ajax({
        url: url,
        dataType: "json",
        cache: false,
        async: false,
        success: function(data, textStatus){
        // 成功したとき
        // console.log(data);
        for(i = 0; i < data.length; i++){
            if(data[i].open !=null && data[i].close !=null && data[i].open !=null && data[i].high !=null  && data[i].low !=null){
                candle_data.push([data[i].minute,data[i].low,data[i].open,data[i].close,data[i].high]);
            }
        }
        // ComboChart(data);
        // console.log(candle_data);
        
        // data にサーバーから返された html が入る
        },
        error: function(xhr, textStatus, errorThrown){
        // エラー処理
        alert("通信エラーが発生しました。");
        }
    });
    // console.log(candle_data);
    var data = google.visualization.arrayToDataTable(
    // [
    // ['Mon', 20, 28, 38, 45],
    // ['Tue', 31, 38, 55, 66],
    // ['Wed', 50, 55, 77, 80],
    // ['Thu', 77, 77, 66, 50],
    // ['Fri', 68, 66, 22, 15]
    // Treat first row as data as well.
    // ]
    candle_data
    , true);

    var options = {
    legend: 'none',
        bar: { groupWidth: '100%' }, // Remove space between bars.
        candlestick: {
        fallingColor: { strokeWidth: 0, fill: 'red' }, // red
        risingColor: { strokeWidth: 0, fill: 'blue' },   // greenhAxis.showTextEvery:{}
        }
    };

    var chart = new google.visualization.CandlestickChart(document.getElementById('chart_div'));
    if(candle_data.length >= 1){
        chart.draw(data, options);
    }else{
        alert('時間外もしくは休場のためデータ取得できません');
    }
}

function drawChart() {
    
    var date1 = $('#chart_date').val();
    date2 = date1.replace(/-/g ,'');
    var chartInterval = $('#chart_Interval').val();
    // console.log(date);
    // console.log(chartInterval);
    // alert(url);
    if(date2 && chartInterval){
        chart_fetch_draw(date2,chartInterval);
    }
}

function aveData_onajax_success(result,textStatus){
    // var day = new Date();
    // var ts278 = day.setDate(day.getDate() -278);
    // var ts178 = day.setDate(day.getDate() -178);
    // var ts128 = day.setDate(day.getDate() -128);
    // var ts103 = day.setDate(day.getDate() -103);
    // var ts83 = day.setDate(day.getDate() -83);
    // var av200 = [];
    // var av100 = [];
    // var av50 = [];
    // var av25 = [];
    // var av5 = [];
    // for(i = 0; i < result.length; i++){
    //     if(Date.parse(result[i].date) < ts278){
    //         av200.push[result[i]];
    //     }
    //     if(Date.parse(result[i].date) < ts178){
    //         av100.push[result[i]];
    //     }
    //     if(Date.parse(result[i].date) < ts128){
    //         av50.push[result[i]];
    //     }
    //     if(Date.parse(result[i].date) < ts103){
    //         av25.push[result[i]];
    //     }
    //     if(Date.parse(result[i].date) < ts83){
    //         av5.push[result[i]];
    //     }
    // }
    //チャートに描画するための最終的なデータを入れる
    var chartData = new google.visualization.DataTable();
    //日付ようにString型のカラムを一つ、チャート描画用に数値型のカラムを７つ作成
    chartData.addColumn('string');
    for(var x = 0;x < 9; x++){
        chartData.addColumn('number');
    }
    //いちいち書くのが面倒なので、取得した情報の長さを配列に入れる
    var length = result.length;
    //描画用のデータを一時的に入れる
    var insertingData = new Array(30);
    //平均を出すための割り算の分母
    var divide = 0;
    //二次元配列aveに、平均線の日数と平均値を入れる
    var ave = new Array();
    //５日平均線用
    ave[0] = new Array();
    //25日平均線用
    ave[1] = new Array();
    //50日平均線用
    ave[2] = new Array();
    //100日平均線用
    ave[3] = new Array();
    //200日平均線用
    ave[4] = new Array();
    //平均線の計算に用いる
    var temp = 0;
    //５日移動平均線の算出
    //基準日より５日前までのデータを足し合わせ、平均値を出す
    var c = 0;
    for(var m = result.length - 35; m < length - 5; m++){
        for(var n = 0; n < 5; n++){
            if(result[m+n].close != ''){
                temp = temp + parseFloat(result[m+n].close);
                divide++;
            }
        }
        ave[0][c] = temp / divide;
        // console.log(c);
        c++;
        temp = 0;
        divide = 0;
    }
    //2５日移動平均線の算出
    //上と同様の処理
    c = 0;
    for(var m = result.length - 55; m < length - 25; m++){
        for(var n = 0; n < 25; n++){
            if(result[m+n].close != ''){
                temp = temp + parseFloat(result[m+n].close);
                divide++
            }
        }
        ave[1][c] = temp / divide;
        c++;
        temp = 0;
        divide = 0;
    }
    //５0日移動平均線の算出
    //上と同様の処理
    c = 0;
    for(var m = result.length - 80; m < length - 50; m++){
        for(var n = 0; n < 50; n++){
            if(result[m+n].close != ''){
                temp = temp + parseFloat(result[m+n].close);
                divide++
            }
        }
        ave[2][c] = temp / divide;
        c++;
        temp = 0;
        divide = 0;
    }
    //１００日移動平均線の算出
    //上と同様の処理
    c = 0;
    for(var m = result.length - 130; m < length - 100; m++){
        for(var n = 0; n < 100; n++){
            if(result[m+n].close != ''){
                temp = temp + parseFloat(result[m+n].close);
                divide++
            }
        }
        ave[3][c] = temp / divide;
        c++;
        temp = 0;
        divide = 0;
    }
    //２００日移動平均線の算出
    //上と同様の処理
    c = 0
    for(var m = result.length - 230; m < length - 200; m++){
        for(var n = 0; n < 200; n++){
            if(result[m+n].close != ''){
                temp = temp + parseFloat(result[m+n].close);
                divide++
            }
        }
        ave[4][c] = temp / divide;
        c++;
        temp = 0;
        divide = 0;
    }
    //for文をまとめるため、出来高棒グラフの処理もここで行う
    //出来高を保持する配列
    var volume = new Array();
    //チャートの日付を保持する配列
    var dates = new Array();
    for(var s = 0; s < length; s++){
        if(result[s].volume != ''){
            volume[s] = result[s].volume;
            dates[s] = String(result[s].date);
        }
    }
    //配列insertingDataの中に、[安値、始値、高値、終値、５日移動平均線、２５日移動平均線、５０日移動平均線、１００日移動平均線、２００日移動平均線]の形で値を入れ込む
    for(var a = 0; a < 30; a++){
        insertingData[a] = [
            dates[a + length - 30],
            parseFloat(result[a + length - 30].low),
            parseFloat(result[a + length - 30].open),
            parseFloat(result[a + length - 30].close),
            parseFloat(result[a + length - 30].high),
            ave[0][a],
            ave[1][a],
            ave[2][a],
            ave[3][a],
            ave[4][a]
        ];
        // console.log(ave[0][a],ave[1][a],ave[2][a]);
    }
    //チャート描画用の配列の中に、insertingDataの値を入れ込む
    //最古の50日分のデータまでは移動平均線のデータが揃っていないので、取り除く
    for (var i = 0; i < insertingData.length; i++){
        chartData.addRow(insertingData[i]);
    }
    //チャートの見た目に関する記述、詳細は公式ドキュメントをご覧になってください
    var options = {
        chartArea:{left:80,top:10,right:80,bottom:10},
        colors: ['#003A76'],
        legend: {
            position: 'none',
        },
        vAxis:{
            viewWindowMode:'maximized'
        },
        hAxis: {
            format: 'yy/MM/dd',
            direction: -1,
        },
        bar: { 
            groupWidth: '100%' 
        },
        width: 1000,
        height: 500,
        lineWidth: 2,
        curveType: 'function',
        //チャートのタイプとして、ローソク足を指定
        seriesType: "candlesticks",  
        //ローソク足だでなく、線グラフも三種類表示することを記述
        series: {
            1:{
                type: "line",
                color: 'green',
            },
            2:{
                type: "line",
                color: 'red',                
            },
            3:{
                type: "line",
                color: 'orange',                
            },
            4:{
                type: "line",
                color: 'blue',                
            },
            5:{
                type: "line",
                color: 'navy',                
            }
        } 
    };
    //描画の処理
    var chart = new google.visualization.ComboChart(document.getElementById('appendMain'));
    chart.draw(chartData, options);
    //出来高棒グラフを作成する関数を呼び出し
    volumeChart(volume, dates, length);
}

function aveData(){
    var symbol = '{{ $meigara -> symbol }}';
    var hostname =  "{{ request()->getUriForPath('') }}";
    var url = hostname + "/api/Meigara/aveData?symbol=" + symbol;
    // alert(url);
    $.ajax({
        url: url,
        dataType: "json",
        cache: false,
        success: function(data, textStatus){
            aveData_onajax_success(data,textStatus);
            // 成功したとき
            // console.log(data);
        
        },
        error: function(xhr, textStatus, errorThrown){
            // エラー処理
            alert("通信エラーが発生しました。");
        }
    });
}

function volumeChart(volume, dates, length){
        var chartData = new google.visualization.DataTable();
        //出来高の値と日付のためのカラムを作成
        chartData.addColumn('string');
        chartData.addColumn('number');
        var insertingData = new Array();
        //配列insertingDataの中に、[日付、出来高]の形式でデータを入れ込む
        for(var a = 0; a < length; a++){
            insertingData[a] = [dates[a],parseInt(volume[a])]
        }
        //insertingDataの値をチャート描画用の変数に入れ込む
        for (var i = insertingData.length - 50; i > 0; i--){
            chartData.addRow(insertingData[i]);
        }
        //ローソク足の時と同じように、見た目の設定をする
        var options = {
            chartArea:{left:80,top:10,right:80,bottom:80},
            colors: ['#003A76'],
            legend: {
                position: 'none',
            },
            bar: { 
                groupWidth: '100%' 
            },
            hAxis: {direction: -1},
            width: 800,
            vAxis:{
                viewWindowMode:'maximized'
            },
        }
        var chart = new google.visualization.ColumnChart(document.getElementById('appendVolume'));
        chart.draw(chartData, options);
}

    
    
    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(
        function() {
            var data = google.visualization.arrayToDataTable([
            [       '', '売上高', '営業利益', '経常利益'],
            ['2004 年',     1000,        400,        380],
            ]);

            var options = {
                title: '会社業績',
                vAxis: {title: '年度'}
            };
            var chart = new google.visualization.BarChart(document.getElementById('gct_sample_bar'));
            chart.draw(data, options);
        }
    );

function dateChange(){
    drawChart();
    aveData();
}

dateChange();
</script>
@endsection
@section('content')
    <table>
        <tr>
            <th>買値：</th>
            <td id="bidPrice"></td>
        </tr>
        <tr>
            <th>購入単位：</th>
            <td id="bidSize"></td>
        </tr>
        <tr>
            <th>売値：</th>
            <td id="askPrice"></td>
        </tr>
        <tr>
            <th>売却単位：</th>
            <td id="askSize"></td>
        </tr>
        <tr>
            <th>前日終値買値：</th>
            <td id="lastUpdated"></td>
        </tr>
        <tr>
            <th>前日終値売値：</th>
            <td id="lastSalePrice"></td>
        </tr>
        <tr>
            <th>前日購入取引量：</th>
            <td id="lastSaleSize"></td>
        </tr>
        <tr>
            <th>前日売却終了日時：</th>
            <td id="lastSaleTime"></td>
        </tr>
        <tr>
            <th>前日売却取引量：</th>
            <td id="volume"></td>
        </tr>
    </table>
<input type="date" id="chart_date" onchange="dateChange()" value="{{ date('Y-m-d',time()-86400) }}">
<select name="chart_Interval" id="chart_Interval" onchange="drawChart()">
    <option value="1">1</option>
    <option value="3">3</option>
    <option value="5" selected>5</option>
    <option value="15">15</option>
    <option value="30">30</option>
    <option value="45">45</option>
    <option value="60">1時間</option>
    <option value="120">2時間</option>
    <option value="180">3時間</option>
    <option value="240">4時間</option>
</select>
<div id="chart_div" style="width: 900px; height: 900px;"></div>
<!-- ローソク足及び移動平均線グラフを配置 -->
<div id='appendMain'></div>
<!-- 出来高の棒グラフを配置 -->
<div id='appendVolume'></div>
<!-- 1日レンジを配置 -->
<div id='gct_sample_bar'></div>
<a class="btn-outline-primary btn" href="{{route('Meigara.index',[''])}}"><i class="fas fa-cog"></i>一覧戻る</a>
@endsection