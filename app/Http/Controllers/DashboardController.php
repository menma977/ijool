<?php

namespace App\Http\Controllers;

use App\Models\MarketPrice;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
  /**
   * @return Application|Factory|View
   */
  public function index()
  {
    return view("dashboard");
  }

  /**
   * @return array
   */
  public function candle(): array
  {
    $marketPrice = MarketPrice::orderBy("created_at", "desc")->first();
    if ($marketPrice) {
      return [
        "index" => 100,
        "buy" => round(($marketPrice->buy * 1500) / 10 ** 8, 8),
        "sell" => round(($marketPrice->sell * 1500) / 10 ** 8, 8),
        "last" => round(($marketPrice->last * 1500) / 10 ** 8, 8),
        "high" => round(($marketPrice->high * 1500) / 10 ** 8, 8),
        "low" => round(($marketPrice->low * 1500) / 10 ** 8, 8),
      ];
    }
    return [
      "index" => 100,
      "buy" => 0,
      "sell" => 0,
      "last" => 0,
      "high" => 0,
      "low" => 0,
    ];
  }
}
