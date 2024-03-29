<?php

use App\Http\Controllers\api\Auth\LoginController;
use App\Http\Controllers\api\Auth\LogoutController;
use App\Http\Controllers\api\CoinController;
use App\Http\Controllers\api\SubscribeController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\VersionController;
use App\Http\Controllers\DashboardController;
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

Route::group(["prefix" => "version", "as" => "version."], function () {
  Route::get("", [VersionController::class, "index"]);
});

Route::middleware(["auth:api", "verified"])->group(function () {
  Route::get("logout", [LogoutController::class, "index"]);

  Route::get("check", [LoginController::class, "check"]);

  Route::group(["prefix" => "dashboard", "as" => "dashboard."], function () {
    Route::get("candle", [DashboardController::class, "candle"]);
  });

  Route::group(["prefix" => "subscribe", "as" => "subscribe."], function () {
    Route::get("", [SubscribeController::class, "index"]);
  });

  Route::group(["prefix" => "coin", "as" => "coin."], function () {
    Route::post("withdraw", [CoinController::class, "withdraw"])->middleware(["throttle:6,1"]);
    Route::post("transfer", [CoinController::class, "transfer"])->middleware(["throttle:6,1"]);
  });

  Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('mates/{user?}', [UserController::class, "mates"]);
    Route::get('{user?}', [UserController::class, "profile"]);
    Route::post('update/{id?}', [UserController::class, "update"]);
  });
});
