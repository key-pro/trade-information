
<?php $__env->startSection('title','FX通貨一覧'); ?>
<?php $__env->startSection('content'); ?>
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
    <!-- <tr>
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
    </tr> -->
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
    function my_round(value,pos){
        return Math.round(value * (10 ** pos))/(10 ** pos);
    }

    function fx_rate(){
        var symbol = "USDJPY";
        // console.log(symbol);
        var hostname = "<?php echo e(request()->getUriForPath('')); ?>";
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
                    console.log(data[i].symbol);
                    var currency = data[i].symbol;
                    $('#'+ currency + "_country").text(data[i].symbol);
                    $('#'+ currency + "_currency_pairs").text(data[i].symbol);
                    $('#'+ currency + "_before_value").text($('#'+ currency + "_after_value").text());
                    $('#'+ currency + "_after_value").text(my_round(data[i].rate,5));
                    var value = $('#'+ currency + "_after_value").text() - $('#'+ currency + "_before_value").text();
                    $('#'+ currency + "_fluctuation").text(my_round(value,4));
                    $('#'+ currency + "_timestamp").text((new Date(data[0].timestamp)).toString());
                    if($('#'+ currency + "_before_value").text()){
                        var ave = ($('#'+ currency + "after_fluctuation").text() / $('#'+ currency + "_before_value").text()) * 100;
                        try{
                            // console.log(ave);
                            // if(ave){
                            //     if(("" + ave).indexOf("0.00")){
                            //         ave = my_round(ave,5);
                            //     }else if(("" + ave).indexOf("0.0")){
                            //         ave = my_round(ave,4);
                            //     }else if(("" + ave).indexOf("0.")){
                            //         ave = my_round(ave,3);
                            //     }else{
                            //         ave = my_round(ave,6)
                            //     }
                            // }
                            $('#'+ currency + "_variation").text(ave  + "%");
                        }catch(e){
                            console.log(e.getMessage());
                        }
                    }
                }
            },
            error: function(xhr, textStatus, errorThrown){
                // エラー処理
                alert("通信エラーが発生しました。");
            }
        });
        
    }
    fx_rate();
    setInterval(fx_rate,5000);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.myapp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\sample\resources\views/FX/index.blade.php ENDPATH**/ ?>