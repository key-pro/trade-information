<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => 'https://currencyapi.net/api/v1/rates?key=yuSkajIGZQ46gEFd7bQ2ieF1opgW7KcX73Jo&output=JSON&base=JPY',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        // echo $response;

        $json = json_decode($response, true);

        $fx_full_value = [];
        $currency_pairs = [];


        foreach ($json['rates'] as $currency => $rate) {
            $fx_full_value[] = ["symbol" => $currency."JPY", "rate" => $rate, $json["updated"]];
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

}
