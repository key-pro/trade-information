<?php

use App\Models\Meigara;
use Illuminate\Contracts\Redis\Connector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("Meigara/aveData",[App\Http\Controllers\MeigaraController::class,"aveData"])->name("Api.Meiagra.aveData");
Route::get("Meigara/summary_data",[App\Http\Controllers\MeigaraController::class,"summaryData"])->name("Api.Meiagra.summarytData");
Route::get("Meigara/chart_data",[App\Http\Controllers\MeigaraController::class,"chartData"])->name("Api.Meiagra.chartData");
Route::get("FX/rates",[App\Http\Controllers\FxController::class,"rateData"])->name("Api.FX.rateData");
Route::get("/FX/Full_var",[App\Http\Controllers\FxController::class,"api_full_data"])->name("Api.FX.full_data");
Route::get("/FX/fx_open",[App\Http\Controllers\FxController::class,"fx_open"])->name("Api.FX.fx_open");