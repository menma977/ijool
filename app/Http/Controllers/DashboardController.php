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
    $marketPrice = MarketPrice::orderBy("created_at", "asc")->get();
    foreach ($marketPrice as $index => $item) {
      $this->jsonDataMarket[$index] = [
        "x" => Carbon::parse($item->created_at)->format("H:i:s"),
        "y" => [
          $item->last,
          $item->high,
          $item->low,
          $item->sell
        ]
      ];
    }
    $data = [
      "marketPrice" => $this->jsonDataMarket,
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
        "x" => Carbon::parse($marketPrice->created_at)->format("H:i:s"),
        "y" => [
          $marketPrice->last,
          $marketPrice->high,
          $marketPrice->low,
          $marketPrice->sell
        ]
      ];
    }
    return [
      "x" => Carbon::now()->format("H:i:s"),
      "y" => [0, 0, 0, 0]
    ];
  }
}
