<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscribeController;
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
});

require __DIR__ . '/auth.php';
