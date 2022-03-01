<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(
    ["middleware" => "auth"],
    function() {
        Route::get("/MeigaraCategorys/create",[App\Http\Controllers\MeigaraCategoryController::class,"create"])->name("MeigaraCategory.create");
        Route::post("/MeigaraCategorys/storeConfirm",[App\Http\Controllers\MeigaraCategoryController::class,"storeConfirm"])->name("MeigaraCategory.storeCofirm");
        Route::post("/MeigaraCategorys",[App\Http\Controllers\MeigaraCategoryController::class,"store"])->name("MeigaraCategory.store");
        Route::get("/MeigaraCategorys/{meigaraCategory}/edit",[App\Http\Controllers\MeigaraCategoryController::class,"edit"])->name("MeigaraCategory.edit");
        Route::put("/MeigaraCategorys/{meigaraCategory}",[App\Http\Controllers\MeigaraCategoryController::class,"update"])->name("MeigaraCategory.update");
        Route::get("/MeigaraCategorys/{meigaraCategory}/delete",[App\Http\Controllers\MeigaraCategoryController::class,"delete"])->name("MeigaraCategory.delete");
        Route::delete("/MeigaraCategorys/{meigaraCategory}",[App\Http\Controllers\MeigaraCategoryController::class,"destroy"])->name("MeigaraCategory.destroy");
        Route::get("/Meigara/create",[App\Http\Controllers\MeigaraController::class,"create"])->name("Meigara.create");
        Route::post("/Meigara/storeConfirm",[App\Http\Controllers\MeigaraController::class,"storeConfirm"])->name("Meigara.storeConfirm");
        Route::post("/Meigara",[App\Http\Controllers\MeigaraController::class,"store"])->name("Meigara.store");
        Route::get("/Meigara/{meigara}/edit",[App\Http\Controllers\MeigaraController::class,"edit"])->name("Meigara.edit");
        Route::put("/Meigara/{meigara}",[App\Http\Controllers\MeigaraController::class,"update"])->name("Meigara.update");
        Route::get("/Meigara/{meigara}/delete",[App\Http\Controllers\MeigaraController::class,"delete"])->name("Meigara.delete");
        Route::delete("/Meigara/{meigara}",[App\Http\Controllers\MeigaraController::class,"destroy"])->name("Meigara.destroy");
    }
);

Route::get("/Meigara",[App\Http\Controllers\MeigaraController::class,"index"])->name("Meigara.index");
Route::get("/MeigaraCategorys",[App\Http\Controllers\MeigaraCategoryController::class,"index"])->name("MeigaraCategory.index");
Route::get("/Meigara/{meigara}/show",[App\Http\Controllers\MeigaraController::class,"show"])->name("Meigara.show");
Route::get("/FX",[App\Http\Controllers\FxController::class,"index"])->name("FX.index");
Route::get("/FX/TEST",[App\Http\Controllers\FxController::class,"index_test"])->name("FX.index_test");
Route::get("Tradingrules",[App\Http\Controllers\TradingrulesController::class,"show"])->name("Tradingrules.show");
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
