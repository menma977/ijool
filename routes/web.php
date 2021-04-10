<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogeController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\SettingSubscribeController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\UserController;
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

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");

Route::get("/", function () {
  return redirect()->route("login");
  //return view("welcome");
})->name("welcome");

Route::get("terms_of_service", function () {
  return view("rule");
})->name("rule");

Route::middleware(["auth", "verified"])->group(static function () {
  Route::group(["prefix" => "dashboard", "as" => "dashboard."], function () {
    Route::get("", [DashboardController::class, "index"])->name("index");
    Route::get("android", [DashboardController::class, "android"])->name("android");
    Route::get("desktop", [DashboardController::class, "desktop"])->name("desktop");
    Route::get("candle", [DashboardController::class, "candle"])->name("candle");
  });

  Route::group(["prefix" => "subscribe", "as" => "subscribe."], function () {
    Route::get("agree/{type}", [SubscribeController::class, "subscribe"])->name("agree");
    Route::group(["prefix" => "config", "as" => "config.", "middleware" => "can:Admin"], function () {
      Route::get("", [SettingSubscribeController::class, "index"])->name("index");
      Route::get("edit", [SettingSubscribeController::class, "edit"])->name("edit");
      Route::post("update", [SettingSubscribeController::class, "update"])->name("update");
    });
  });

  Route::group(["prefix" => "user", "as" => "user."], function () {
    Route::get("profile", [UserController::class, "profile"])->name("profile");
    Route::get("create", [UserController::class, "create"])->name("create");
    Route::post("store", [UserController::class, "store"])->name("store");
    Route::get("edit/{id}", [UserController::class, "edit"])->name("edit");
    Route::post("update/{id}", [UserController::class, "update"])->name("update");
    Route::group(["prefix" => "balance", "as" => "balance."], function () {
      Route::get("doge/{id}", [UserController::class, "getDogeBalance"])->name("doge")->middleware(["throttle:4,1"]);
      Route::get("bot/{id}", [UserController::class, "getTradingBalance"])->name("bot")->middleware(["throttle:4,1"]);
    });
  });

  Route::group(["prefix" => "doge", "as" => "doge."], function () {
    Route::get("url", [DogeController::class, "url"])->name("url");
    Route::post("transfer/{type}/{isAll}", [DogeController::class, "transfer"])->name("transfer");
    Route::get("history/{type}/{target}/{next?}", [DogeController::class, "history"])->name("history");
    Route::group(["prefix" => "withdraw", "as" => "withdraw."], function () {
      Route::get("", [DogeController::class, "createWithdraw"])->name("create");
      Route::post("store", [DogeController::class, "storeWithdraw"])->name("store");
    });
    Route::group(["prefix" => "mining", "as" => "bet."], function () {
      Route::get("", [DogeController::class, "index"])->name("index");
      Route::post("store", [DogeController::class, "store"])->name("store");
    });
  });

  Route::group(["prefix" => "line", "as" => "line.", "middleware" => "can:Admin"], function () {
    Route::get("", [LineController::class, "index"])->name("index");
    Route::get("show/{username}", [LineController::class, "show"])->name("show");
  });

  Route::group(["prefix" => "pin", "as" => "pin."], function () {
    Route::get("", [PinController::class, "index"])->name("index");
    Route::post("store", [PinController::class, "store"])->name("store");
  });
});

require __DIR__ . "/auth.php";
