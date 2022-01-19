
<?php $__env->startSection('title'); ?>
<?php echo e($meigara -> meigara_name); ?>株価詳細
<?php $__env->stopSection(); ?>
<?php $__env->startSection('header_js'); ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
     var candle_data = [];
    /** 現在のDateオブジェクト作成 */
    // var d = new Date();
    /** 文字列に日付をフォーマットする */
    // var formatted = `${d.getFullYear()}-${d.getMonth()+1}-${d.getDate()}`.replace(/\n|\r/g, '');
    // var date = formatted;
    // $('#chart_date').val(date);

     function api_exchange(){
        var symbol = '<?php echo e($meigara -> symbol); ?>';
        var hostname =  "<?php echo e(request()->getUriForPath('')); ?>";
        var url = hostname + "/api/Meigara/summary_data?symbol=" + symbol;
        // alert(url);
        $.ajax({
            url: url,
            dataType: "json",
            cache: false,
            success: function(data, textStatus){
            // 成功したとき
            // console.log(data);

            if(data[0].bidPrice == 0){
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
        var symbol = '<?php echo e($meigara -> symbol); ?>';
        var hostname = "<?php echo e(request()->getUriForPath('')); ?>";
        // alert(hostname);
        var url = hostname + "/api/Meigara/chart_data?symbol=" + symbol + "&chartdate=" + date + "&chartInterval=" + chartInterval;
        console.log(url);
        candle_data = [];
        $.ajax({
            url: url,
            dataType: "json",
            cache: false,
            async: false,
            success: function(data, textStatus){
            // 成功したとき
            console.log(data);
            for(i = 0; i < data.length; i++){
                if(data[i].open !=null && data[i].close !=null && data[i].open !=null && data[i].high !=null  && data[i].low !=null){
                    candle_data.push([data[i].minute,data[i].low,data[i].open,data[i].close,data[i].high])
                }
            }
            console.log(candle_data);
            
            // data にサーバーから返された html が入る
            },
            error: function(xhr, textStatus, errorThrown){
            // エラー処理
            alert("通信エラーが発生しました。");
            }
        });
        console.log(candle_data);
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
            risingColor: { strokeWidth: 0, fill: 'blue' },   // green
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
        
        var date = $('#chart_date').val();
        date = date.replace(/-/g ,'');
        var chartInterval = $('#chart_Interval').val();
        console.log(date);
        console.log(chartInterval);
        // alert(url);
        if(date && chartInterval){
            chart_fetch_draw(date,chartInterval);
        }
    }  
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
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
<input type="date" id="chart_date" onchange="drawChart()" value="<?php echo e(date('Y-m-d',time()-86400)); ?>">
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
<a class="btn-outline-primary btn" href="<?php echo e(route('Meigara.index',[''])); ?>"><i class="fas fa-cog"></i>一覧戻る</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/Meigara/show.blade.php ENDPATH**/ ?>