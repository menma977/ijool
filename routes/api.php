<?php

use App\Http\Controllers\api\Auth\LoginController;
use App\Http\Controllers\api\Auth\LogoutController;
use App\Http\Controllers\api\CoinController;
use App\Http\Controllers\api\SubscribeController;
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

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");

Route::post("/login", [LoginController::class, "index"])->middleware(["throttle:1,1", "guest"]);

Route::middleware(["auth:api", "verified"])->group(function () {
  Route::get("logout", [LogoutController::class, 'index']);

  Route::group(["prefix" => "dashboard", "as" => "dashboard."], function () {
    Route::get("candle", [DashboardController::class, "candle"]);
  });

  Route::get("check", [LoginController::class, "check"]);

  Route::group(["prefix" => "subscribe", "as" => "subscribe."], function () {
    Route::get("", [SubscribeController::class, "index"]);
  });

  Route::group(["prefix" => "coin", "as" => "coin."], function () {
    Route::post("withdraw", [CoinController::class, "withdraw"])->middleware(["throttle:6,1"]);
    Route::post("transfer", [CoinController::class, "transfer"])->middleware(["throttle:6,1"]);
  });
});

Route::group(['prefix' => 'pc', 'as' => 'pc.'], function () {
  Route::post("/login", [LoginController::class, "pc_login"])->middleware(["guest"]);
});
