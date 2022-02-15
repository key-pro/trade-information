<?php

namespace App\Http\Controllers;

use App\Models\Meigara;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MeigaraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Meigara::orderBy('created_at',"desc")->paginate(3);
        $text_meigara_name_part = request()->input("text_meigara_name_part");
        $data = Meigara::where("meigara_name","like","%{$text_meigara_name_part}%")->orderBy('created_at',"desc")->paginate(3);
        // $data = MeigaraCategory::all();
        return view("Meigara.index",["meigaras" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Gate::authorize("Meigara_create");
        return view("Meigara.create");
    }

    public function storeConfirm(){
        $data = request()->all();
        return view("Meigara.storeConfirm"); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();
        Meigara::create($data);
        return redirect()->route('Meigara.index')->with('message','銘柄登録しました。');
        $text_meigara_name_part = request()->input("text_meigara_name_part");
        $data = Meigara::where("meigara_name","like","%{$text_meigara_name_part}%")->orderBy('created_at',"desc")->paginate(3);
        // $data = Meigara::all();
        return view("Meigara.index",['meigara'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Meigara  $meigara
     * @return \Illuminate\Http\Response
     */
    public function show(Meigara $meigara)
    {
        //
        return view("Meigara.show",["meigara" => $meigara]);
    }

    public function summaryData(Request $request){
        $apikey = config("custom.iex_api_key");
        $symbol = $request->input("symbol");
        // dd($symbol,$chartdate,$chartInterval);
        $url = "https://cloud.iexapis.com/stable/tops?token=" . $apikey . "&symbols=" . $symbol;
        // dd($url);
        $json = file_get_contents($url);
        // dd($url);
        if($json !== false){
            echo $json;
        }else{
            echo json_encode([ "status" => "error","server_response" => $http_response_header[0]]);
        }
    }

    public function chartData(Request $request){
        $apikey = config("custom.iex_api_key");
        $symbol = $request->input("symbol");
        $chartdate = $request->input("chartdate");
        $chartInterval = $request->input("chartInterval");
        // dd($symbol,$chartdate,$chartInterval);
        $url = "https://cloud.iexapis.com/stable/stock/" . $symbol . "/chart/date/" . $chartdate . "?chartInterval=" . $chartInterval . "&token=" . $apikey;
        $json = file_get_contents($url);
        if($json !== false){
            echo $json;
        }else{
            echo json_encode([ "status" => "error","server_response" => $http_response_header[0]]);
        }
    }

    public function aveData(Request $request){
        $apikey = config("custom.iex_api_key");
        $symbol = $request->input("symbol");
        $url = "https://cloud.iexapis.com/stable/stock/" . $symbol . "/chart/" . "1y" . "?token=" . $apikey;
        $json = file_get_contents($url);
        if($json !== false){
            echo $json;
        }else{
            echo json_encode([ "status" => "error","server_response" => $http_response_header[0]]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Meigara  $meigara
     * @return \Illuminate\Http\Response
     */
    public function edit(Meigara $meigara)
    {
        //
        return view("Meigara.edit",['meigara' => $meigara]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Meigara  $meigara
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meigara $meigara)
    {
        //
        $data = $request -> all();
        $meigara->fill($data)->save();
        return redirect()->route("Meigara.edit",["meigara" => $meigara])->with("message","変更完了しました。");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Meigara  $meigara
     * @return \Illuminate\Http\Response
     */

    public function delete(Meigara $meigara)
    {
        return view("Meigara.delete",["meigara" => $meigara]);
    }
    public function destroy(Meigara $meigara)
    {
        //
        $meigara -> delete();
        return redirect()->route("Meigara.index")->with("message","削除完了しました。");
    }
}
