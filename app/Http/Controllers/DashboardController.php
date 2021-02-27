<?php

namespace App\Http\Controllers;

use App\Models\MarketPrice;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
  private $jsonDataMarket;

  /**
   * @return Application|Factory|View
   */
  public function index()
  {
    $xIndex = [];
    $buy = [];
    $sell = [];
    $last = [];
    $high = [];
    $low = [];
    $marketPrice = MarketPrice::orderBy("created_at", "asc")->take(50)->get();
    foreach ($marketPrice as $index => $item) {
      $xIndex[$index] = $index + 1;
      $buy[$index] = round(($item->buy * 1500) / 10 ** 8, 8);
      $sell[$index] = round(($item->sell * 1500) / 10 ** 8, 8);
      $last[$index] = round(($item->last * 1500) / 10 ** 8, 8);
      $high[$index] = round(($item->high * 1500) / 10 ** 8, 8);
      $low[$index] = round(($item->low * 1500) / 10 ** 8, 8);
    }
    $data = [
      "marketPrice" => $this->jsonDataMarket,
      "index" => $xIndex,
      "buy" => $buy,
      "sell" => $sell,
      "last" => $last,
      "high" => $high,
      "low" => $low,
    ];

    return view("dashboard", $data);
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
