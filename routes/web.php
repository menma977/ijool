<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DogeController;
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

Route::get('/', function () {
//  return view('welcome');
  return redirect()->route('login');
})->name("welcome");

Route::get("terms_of_service", function () {
  return view("rule");
})->name("rule");

Route::middleware(['auth', 'verified'])->group(static function () {
  Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
    Route::get("", [DashboardController::class, 'index'])->name('index');
    Route::get("candle", [DashboardController::class, 'candle'])->name('candle');
  });

  Route::group(['prefix' => 'subscribe', 'as' => 'subscribe.'], function () {
    Route::get("agree", [SubscribeController::class, 'subscribe'])->name('agree');
  });

  Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::get("profile", [UserController::class, 'profile'])->name('profile');
    Route::get("edit/{id}", [UserController::class, 'edit'])->name('edit');
    Route::post("update/{id}", [UserController::class, 'update'])->name('update');
    Route::group(['prefix' => 'balance', 'as' => 'balance.'], function () {
      Route::get("doge/{id}", [UserController::class, 'getDogeBalance'])->name('doge')->middleware(['throttle:2,1']);
      Route::get("bot/{id}", [UserController::class, 'getTradingBalance'])->name('bot')->middleware(['throttle:2,1']);
    });
  });

  Route::group(['prefix' => 'doge', 'as' => 'doge.'], function () {
    Route::post("transfer/{type}/{isAll}", [DogeController::class, 'createWithdraw'])->name('transfer');
    Route::group(['prefix' => 'withdraw', 'as' => 'withdraw.'], function () {
      Route::get("", [DogeController::class, 'createWithdraw'])->name('create');
      Route::post("store", [DogeController::class, 'storeWithdraw'])->name('store');
    });
    Route::group(['prefix' => 'bet', 'as' => 'bet.'], function () {
      Route::get("", [DogeController::class, 'index'])->name('index');
      Route::post("store", [DogeController::class, 'store'])->name('store');
    });
  });
});

require __DIR__ . '/auth.php';
