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
            $('#kounyu_kabuka_rate').text("取引時間外").css({"color":"red","font-weight":"bold"});
            //リアルタイム購入入力チェック用為替レート
            fx_rate();
        }else{
            $('#bidPrice').text(data[0].bidPrice);
            $('#bidSize').text(data[0].bidSize);
            $('#askPrice').text(data[0].askPrice);
            $('#askSize').text(data[0].askSize);
            $('#kounyu_kabuka_rate').text(data[0].bidPrice);
             //リアルタイム購入入力チェック用為替レート
            fx_rate();
            kainecheck(data);
        }
        $('#lastUpdated').text((new Date(data[0].lastUpdated)).toString());
        $('#lastSalePrice').text(data[0].lastSalePrice);
        $('#lastSaleSize').text(data[0].lastSaleSize);
        if(data[0].lastSaleTime != 0){
            $('#lastSaleTime').text((new Date(data[0].lastSaleTime)).toString());
        }else{
            $('#lastSaleTime').text((new Date(data[0].lastUpdated)).toString());
        }
        $('#volume').text(data[0].volume);

        // data にサーバーから返された html が入る
        },
        error: function(xhr, textStatus, errorThrown){
        // エラー処理
        alert("通信1エラーが発生しました。");
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
        //レンジ範囲値渡し
        BarChart(data,chartInterval);
        //リアルタイム購入入力チェック
        // ComboChart(data);
        // console.log(candle_data);
        
        // data にサーバーから返された html が入る
        },
        error: function(xhr, textStatus, errorThrown){
        // エラー処理
        alert("通信2エラーが発生しました。");
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
    }
    // else{
    //     alert('時間外もしくは休場のためデータ取得できません');
    // }
}

function drawChart() {
    aveData();
    
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
    var insertingData_BB = new Array(30);
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
    c = 0;
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
    //ボリンジャーバンド
    var c = 0;
    var sma_bb = [];
    const BB_DATE_SPAN = 20;
    for(var m = result.length - 50; m < result.length - 30; m++){
        for(var n = 0; n < BB_DATE_SPAN; n++){
            if(result[m + n].close != ''){
                temp = temp + parseFloat(result[m+n].close);
                divide++
            }
        }
        sma_bb[c] = temp / divide;
        c++;
        temp = 0;
        divide = 0;
    }

    var averaound = 2;
    var sigma = [];
    c = 0;
    for(var m = result.length - 50; m < result.length -30;  m++){
        var sum_x = 0;
        var sum_bay = 0;
        // console.log(m);
        for(var i = 0; i < BB_DATE_SPAN; i++){
            if(result[m + i].close != ''){
                sum_x = sum_x + parseFloat(result[m + i].close);
                divide++
            }
        }
        xm = sum_x / BB_DATE_SPAN;
        for(var i = 0; i < BB_DATE_SPAN; i++){
            sum_bay += ((parseFloat(result[m + i].close) - xm) ** 2);
            // if(sum_bay < 0){
                // console.log(result[m + i].close);
            // }
        }
        // var work1 = Math.sqrt( sum_bay/ BB_DATE_SPAN);
        // if(isNaN(work1)){
            // console.log(sum_bay);
        // }
        sigma[c] = Math.sqrt( sum_bay/ BB_DATE_SPAN);
        c++;
    }

    var sma_p1 = [];
    var sma_p2 = [];
    var sma_m1 = [];
    var sma_m2 = [];
    for(var i = 0; i < 30; i++){
        sma_p1[i] = sma_bb[i] + sigma[i];
        sma_p2[i] = sma_bb[i] + sigma[i] * 2;
        sma_m1[i] = sma_bb[i] - sigma[i];
        sma_m2[i] = sma_bb[i] - sigma[i] * 2;
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

    //MACD
    var c = 0;
    var macd_ema_fast = [];
    var macd_ema_slow = [];
    var macd_sma = [];
    var macd_history = [];
    var insertingData_MD = new Array(20);
    var insertingData_MD_history = new Array(20);
    const MACD_DATE_SPAN_FAST = 5;
    const MACD_DATE_SPAN_SLOW = 20;
    const SIGNAL_SPAN = 9;
    var alpha_fast = 2 / (MACD_DATE_SPAN_FAST + 1);
    var alpha_slow = 2 / (MACD_DATE_SPAN_SLOW + 1);

    for(var m = result.length - 50; m < result.length - 30; m++){
        var macd_val_ema = 0;
        if(c >= 0){
            for(var n = 0; n < MACD_DATE_SPAN_FAST; n++){
                if(result[m + n].close != ''){
                    macd_val_ema += result[m + n].close;
                }
            }
            macd_val_ema += result[m + MACD_DATE_SPAN_FAST -1].close;
            macd_ema_fast[c] = macd_val_ema / (MACD_DATE_SPAN_FAST + 1);
        }else{
            macd_ema_fast[c - 1] + alpha_fast * (result[m + n].close - macd_ema[c - 1]);
        }

        macd_val_ema = 0;
        if(c >= 0){
            for(var n = 0; n < MACD_DATE_SPAN_SLOW; n++){
                if(result[m + n].close != ''){
                    macd_val_ema += result[m + n].close;
                }
            }
            macd_val_ema += result[m + MACD_DATE_SPAN_SLOW -1].close;
            macd_ema_slow[c] = macd_val_ema / (MACD_DATE_SPAN_SLOW + 1);
        }else{
            macd_ema_slow[c - 1] + alpha_slow * (result[m + n].close - macd_ema[c - 1]);
        }

        var sma_sum = 0;
        for(var n = 0; n < SIGNAL_SPAN; n++){
            if(result[m + n].close != ''){
                sma_sum += result[m + n].close;
            }
        }
        macd_sma[c] = sma_sum / SIGNAL_SPAN;
        macd_history[c] =  (macd_ema_fast[c] - macd_ema_slow[c]);
        c++;
    }
    

    //RSI
    const RSI_SPAN = 15;
    c = 0;
    var rsi = [];
    var insertingData_RSI = new Array(21);
    insertingData_RSI[0] =  ['', 'RSI']; 
    // var highest = 0;
    // var lowest = 100000;
    // var close_sum = 0;
    for(var i = result.length - RSI_SPAN - 20; i < result.length - RSI_SPAN; i++){
        var agari = 0;
        var sagari = 0;
        // close_sum += result[i + RSI_SPAN - 1].close;
        for(var j = 0; j < RSI_SPAN; j++){
            // if(result[m + n].close > highest){
            //     highest = result[m + n].close; 
            // }else if(result[m + n].close < lowest){
            //     lowest = result[m + n].close;
            // }
            var diff = result[i + j].close - result[i + j].open;
            if(diff > 0){
                agari += diff; 
            }else{
                sagari += Math.abs(diff);
            }
        }
        var agari_ave = agari / RSI_SPAN;
        var sagari_ave = sagari / RSI_SPAN;
        rsi[c] = agari_ave / (agari_ave + sagari_ave) * 100;
        c++;
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
        insertingData_BB[a] = [
            dates[a + length - 30],
            parseFloat(result[a + length - 30].low),
            parseFloat(result[a + length - 30].open),
            parseFloat(result[a + length - 30].close),
            parseFloat(result[a + length - 30].high),
            sma_bb[a],
            // sigma[a],
            sma_p1[a],
            sma_p2[a],
            sma_m1[a],
            sma_m2[a]
        ];
        // console.log(ave[0][a],ave[1][a],ave[2][a]);
    }
    for(var b = 0; b < 20; b++){
        insertingData_MD[b] = [
            dates[b + length - 30],
            parseFloat(result[b + length - 30].low),
            parseFloat(result[b + length - 30].open),
            parseFloat(result[b + length - 30].close),
            parseFloat(result[b + length - 30].high),
            macd_ema_fast[b],
            macd_ema_slow[b],
        ];
    }

    for(var b = 0; b < 20; b++){
        insertingData_MD_history[b] = [
            dates[b + length - 30],
            // parseFloat(result[b + length - 30].low),
            // parseFloat(result[b + length - 30].open),
            // parseFloat(result[b + length - 30].close),
            // parseFloat(result[b + length - 30].high),
            macd_history[b]
        ];
    }

    for(var b = 0; b < 20; b++){
        insertingData_RSI[b + 1] = [
            dates[b + length - 30],
            // parseFloat(result[b + length - 30].low),
            // parseFloat(result[b + length - 30].open),
            // parseFloat(result[b + length - 30].close),
            // parseFloat(result[b + length - 30].high),
            rsi[b]
        ];
    }
    //チャート描画用の配列の中に、insertingDataの値を入れ込む
    //最古の50日分のデータまでは移動平均線のデータが揃っていないので、取り除く
    for (var i = 0; i < insertingData.length; i++){
        chartData.addRow(insertingData[i]);
    }

    //ボリンジャーバンド用値と日付のためのカラムを作成
    var chartData_BB = new google.visualization.DataTable();
    chartData_BB.addColumn('string');
    for(var i = 0; i < 9; i++){
        chartData_BB.addColumn('number');
    }
    
    for (var i = 0; i < insertingData_BB.length; i++){
        chartData_BB.addRow(insertingData_BB[i]);
    }
    //MACD用値と日付のためのカラムを作成
    var chartData_MD = new google.visualization.DataTable();
    chartData_MD.addColumn('string');
    for(var i = 0; i < 6; i++){
        chartData_MD.addColumn('number');
    }
    
    for (var i = 0; i < insertingData_MD.length; i++){
        chartData_MD.addRow(insertingData_MD[i]);
    }

    //MACD用値と日付のためのカラムを作成ヒストグラム
    var chartData_MD_history = new google.visualization.DataTable();
    chartData_MD_history.addColumn('string');
    for(var i = 0; i < 1; i++){
        chartData_MD_history.addColumn('number');
    }
    
    for (var i = 0; i < insertingData_MD_history.length; i++){
        chartData_MD_history.addRow(insertingData_MD_history[i]);
    }

    //RSI用値と日付のためのカラムを作成
    var chartData_RSI = new google.visualization.DataTable();
    chartData_RSI.addColumn('string');
    for(var i = 0; i < 1; i++){
        chartData_RSI.addColumn('number');
    }

    //描画の処理RSI
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable( 
        //グラフデータの指定
        // [''],
            insertingData_RSI
        );

        var options_RSI = { 
            //オプションの指定
            title: '折れ線グラフサンプル'
        };

        var chart_RSI = new google.visualization.LineChart(document.getElementById('appendMain_RSI'));
        chart_RSI.draw(data, options_RSI);
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

    //チャートの見た目に関する記述、詳細は公式ドキュメントをご覧になってください
    var options_BB = {
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
            },
            6:{
                type: "line",
                color: 'brown',                
            },
            7:{
                type: "line",
                color: 'lightgreen',                
            },
            8:{
                type: "line",
                color: 'lightblue',                
            },
            9:{
                type: "line",
                color: 'darkgreen',                
            },
            // 10:{
            //     type: "line",
            //     color: 'Yellow',                
            // }
        } 
    };

    //チャートの見た目に関する記述、詳細は公式ドキュメントをご覧になってください
    var options_MD = {
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
            // 3:{
            //     type: "line",
            //     color: 'orange',                
            // },
            // 4:{
            //     type: "line",
            //     color: 'blue',                
            // },
            // 5:{
            //     type: "line",
            //     color: 'navy',                
            // },
            // 6:{
            //     type: "line",
            //     color: 'brown',                
            // },
            // 7:{
            //     type: "line",
            //     color: 'lightgreen',                
            // },
            // 8:{
            //     type: "line",
            //     color: 'lightblue',                
            // },
            // 9:{
            //     type: "line",
            //     color: 'darkgreen',                
            // },
            // 10:{
            //     type: "line",
            //     color: 'Yellow',                
            // }
        } 
    };
    //チャートの見た目に関する記述、詳細は公式ドキュメントをご覧になってください
    var options_MD_history = {
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
            // 2:{
            //     type: "line",
            //     color: 'red',                
            // },
            // 3:{
            //     type: "line",
            //     color: 'orange',                
            // },
            // 4:{
            //     type: "line",
            //     color: 'blue',                
            // },
            // 5:{
            //     type: "line",
            //     color: 'navy',                
            // },
            // 6:{
            //     type: "line",
            //     color: 'brown',                
            // },
            // 7:{
            //     type: "line",
            //     color: 'lightgreen',                
            // },
            // 8:{
            //     type: "line",
            //     color: 'lightblue',                
            // },
            // 9:{
            //     type: "line",
            //     color: 'darkgreen',                
            // },
            // 10:{
            //     type: "line",
            //     color: 'Yellow',                
            // }
        } 
    };
    //チャートの見た目に関する記述、詳細は公式ドキュメントをご覧になってください
    var options_RSI = {
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
            },
            // 6:{
            //     type: "line",
            //     color: 'brown',                
            // },
            // 7:{
            //     type: "line",
            //     color: 'lightgreen',                
            // },
            // 8:{
            //     type: "line",
            //     color: 'lightblue',                
            // },
            // 9:{
            //     type: "line",
            //     color: 'darkgreen',                
            // },
            // 10:{
            //     type: "line",
            //     color: 'Yellow',                
            // }
        } 
    };

    //描画の処理
    var chart = new google.visualization.ComboChart(document.getElementById('appendMain'));
    chart.draw(chartData, options);

    //描画の処理(ボリンジャーバンド)
    var chart_BB = new google.visualization.ComboChart(document.getElementById('appendMain_BB'));
    chart_BB.draw(chartData_BB, options_BB);

    //描画の処理(MACD)
    var chart_MD = new google.visualization.ComboChart(document.getElementById('appendMain_MD'));
    chart_MD.draw(chartData_MD, options_MD);

    //描画の処理(MACD)ヒストグラム
     var chart_MD_history = new google.visualization.Histogram(document.getElementById('appendMain_MD_history'));
    chart_MD_history.draw(chartData_MD_history, options_MD_history);

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
            alert("通信3エラーが発生しました。");
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

    
function BarChart(data,chartInterval){    
    // console.log(data);
    var takane = 0;
    for(var i = 0; i < data.length; i++){
        if(takane < data[i].marketHigh){
            takane = data[i].marketHigh;
        }
    }
    var symbol = '{{ $meigara -> symbol }}';
    var hostname = "{{ request()->getUriForPath('') }}";
    var chartInterval = chartInterval;
    var param_date = new Date();
    // console.log(param_date);
    param_date.setDate(param_date.getDate() - 2);
    var param_Month = param_date.getMonth() + 1;
    var param_Month_str = "";
    if(param_Month >= 10){
        param_Month_str = param_Month.toString();
    }else{
        param_Month_str = "0" + param_Month.toString();
    }
    if(param_date >= 10){
        param_date_str = param_date.toString();
    }else{
        param_date_str = "0" + param_date.toString();
    }
    // console.log(param_Month_str);
    // console.log(param_date_str);
    param_date_str = param_date_str.substr(8,2);
    // console.log(param_date_str);
    param_date = param_date.getFullYear() + param_Month_str + param_date_str;
    // console.log(param_date);
    // alert(hostname);
    var url = hostname + "/api/Meigara/chart_data?symbol=" + symbol + "&chartdate=" + param_date + "&chartInterval=" + chartInterval;
    // console.log(url);
    // alert(url);
    // candle_data = [];
    var ototoi_owarine = 0;
    $.ajax({
        url: url,
        dataType: "json",
        cache: false,
        async: false,
        success: function(data, textStatus){
        // 成功したとき
        // console.log(data);
        
        // data にサーバーから返された html が入る
            if(data != ""){
                
                ototoi_owarine = data[data.length-1].close;
            }
        },
        error: function(xhr, textStatus, errorThrown){
        // エラー処理
        alert("通信4エラーが発生しました。");
        }
    });

    google.load("visualization", "1", {packages:["corechart"]});
    google.setOnLoadCallback(
        function() {
            var data = google.visualization.arrayToDataTable([
            ['', 'レンジ幅'],
            ['レンジ幅',takane - ototoi_owarine]
            ]);

            var options = {
                title: '銘柄',
                vAxis: {title: '銘柄'}
            };
            var chart = new google.visualization.BarChart(document.getElementById('gct_sample_bar'));
            chart.draw(data, options);
        }
    );
}

function fx_rate(){
    var hostname = "{{ request()->getUriForPath('') }}";
    var symbol = "USDJPY";
    var url = hostname + "/api/FX/rates?symbol=" + symbol;
     // console.log(symbol)
    // console.log(hostname);
    // console.log(url);
    $.ajax({
            url: url,
            dataType: "json",
            cache: false,
            async: false,
            success: function(data, textStatus){
                var rate = data[0].rate;
                //Math.ceil(data[0].rate,1)
                // console.log(rate);
                $('#fx_rate').text(rate);
                //リアルタイム購入入力チェック用計算用
            },
            error: function(xhr, textStatus, errorThrown){
                // エラー処理
                alert("通信5エラーが発生しました。");
            }
    });
}

function kainekeisan(kabuka_rate_data,fx_rate){
    var kabuka_rate = kabuka_rate_data;
    var fx_rate = fx_rate;
    var user_ryou =  $('#user_ryou').val();
    // console.log(user_ryou);
    // console.log(kabuka_rate);
    // console.log(fx_rate);
    var kabu_nedan = kabuka_rate * fx_rate;
    // console.log(kabu_nedan);
    var goukei = parseInt(kabu_nedan * user_ryou,10);
    // console.log(goukei);
    $("#goukei").text("合計金額は￥" + goukei + "円").css("font-size","1em");
}

function kainecheck(data){
    var user_ryou = 0;
    var hostname = "{{ request()->getUriForPath('') }}";
    var symbol = "USDJPY";
    var url = hostname + "/api/FX/rates?symbol=" + symbol;
     // console.log(symbol)
    // console.log(hostname);
    // console.log(url);
    var fx_rate = 0;
    $.ajax({
            url: url,
            dataType: "json",
            cache: false,
            async: false,
            success: function(data, textStatus){
                fx_rate = data[0].rate;
                //Math.ceil(data[0].rate,1)
                // console.log(rate);
                $('#fx_rate').text(fx_rate);
            },
            error: function(xhr, textStatus, errorThrown){
                // エラー処理
                alert("通信6エラーが発生しました。");
            }
    });

    if(data[0].bidPrice != "0"){
        var kabuka_rate_data = data[0].bidPrice;
        $('#user_ryou').prop('disabled',false);
        $('#user_ryou_message').text("実際の購入金額計算できます。");
        $('#kingaku_keisan').on('click',function(){
            kainekeisan(kabuka_rate_data,fx_rate);
        })
    }
}

</script>
@endsection
@section('content')
@csrf
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
            <th>前日終値終了日時：</th>
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
<input type="date" id="chart_date" onchange="drawChart()" value="{{ date('Y-m-d',time()-86400) }}">
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
<div class="boxContainer">
    <div class="item" id="chart_div" style="width: 900px; height: 900px;"></div>
    <!-- ローソク足及び移動平均線グラフを配置 -->
    <div class="item" id='appendMain'></div>
    <!-- ローソク足及び移動平均線グラフを配置 -->
    <div class="item" id='appendMain_BB'></div>
    <!-- ローソク足及び移動平均線グラフを配置 -->
    <div class="item" id='appendMain_MD'></div>
    <!-- ローソク足及び移動平均線グラフを配置 -->
    <div class="item" id='appendMain_MD_history'></div>
    <!-- ローソク足及び移動平均線グラフを配置 -->
    <div class="item" id='appendMain_RSI'></div>
    <!-- 出来高の棒グラフを配置 -->
    <div class="item" id='appendVolume'></div>
    <!-- 1日レンジを配置 -->
    <div class="item" id='gct_sample_bar'></div>
    
</div>
<p>実際購入金額</p>
<p id="kounyu_kabuka_rate"></p>
<p>USDレート</p>
<p id="fx_rate"></p>
購入量<input type="number" id="user_ryou" disabled><sub id="user_ryou_message">取引時間外ため使用できません。</sub>
<input type="button" id="kingaku_keisan" value="計算">
<p id="goukei"></p>
<a class="btn-outline-primary btn" href="{{route('Meigara.index',[''])}}"><i class="fas fa-cog"></i>一覧戻る</a>
@endsection