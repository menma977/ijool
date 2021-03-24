<?php

use App\Http\Controllers\PcApi\LoginController;
use App\Http\Controllers\PcApi\UserController;
use Illuminate\Support\Facades\Route;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");

Route::group(['prefix' => 'pc', 'as' => 'pc.'], function () {

  Route::post("/login", [LoginController::class, "pc_login"])->middleware(["guest"]);

  Route::middleware(["auth:api", "verified"])->group(function () {
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
      Route::get('mates/{user?}', [UserController::class, "mates"]);
      Route::get('{user?}', [UserController::class, "profile"]);
      Route::post('update', [UserController::class, "update"]);
    });
    Route::group(["prefix" => "doge", "as" => "doge."], function () {
      Route::post("transfer/{type}/{isAll}", [DogeController::class, "transfer"]);
    });
  });
});
