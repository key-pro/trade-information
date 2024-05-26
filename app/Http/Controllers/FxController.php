<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Codec\TimestampLastCombCodec;

class FxController extends Controller
{
    //
    public function index(){
        return view("FX.index");
    }

    public function full_data(){
        return view("FX.full_data");
    }

    public function api_full_data(){
        $apikey = config("custom.currency_api_key");
        $url = 'https://currencyapi.net/api/v1/rates?key='. $apikey .'&output=JSON&base=JPY';
        $value = file_get_contents($url);
       
        $json = json_decode($value, true);

        $fx_full_value = [];
        $currency_pairs = [];


        foreach ($json['rates'] as $currency => $rate) {
            $fx_full_value[] = ["symbol" => $currency."JPY", "rate" => $rate, "timestamp" => $json["updated"]];
            $currency_pairs[] = $currency."JPY";
        }

        $ret = ['fx_rate' => $fx_full_value, 'currency_pairs' => $currency_pairs];
        echo json_encode($ret);
    }

    public function rateData(Request $request){
        $apikey = config("custom.iex_api_key");
        $symbol = $request->input("symbol");
        $url = "https://cloud.iexapis.com/stable/fx/latest?symbols=" . $symbol . "&token=" . $apikey;
        // dd($url);
        $json = file_get_contents($url);
        // dd($json);
        if($json !== false){
            echo $json;
        }else{
            echo json_encode([ "status" => "error","server_response" => $http_response_header[0]]);
        }
    }

    public function fx_open(Request $request){
        $apikey = config("custom.Openexchangerates_api_key");
        $url = "https://openexchangerates.org/api/latest.json?app_id=" . $apikey;
        $json = file_get_contents($url);
        if($json !== false){
            echo $json;
        }else{
            echo json_encode([ "status" => "error","server_response" => $http_response_header[0]]);
        }
    }

}