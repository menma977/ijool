<?php

namespace App\Http\Controllers;

use App\Models\MarketPrice;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
   * @return Application|Factory|View
   */
  public function android()
  {
    return view("download.android");
  }

  /**
   * @return Application|Factory|View
   */
  public function desktop()
  {
    return view("download.desktop");
  }

  /**
   * @return array
   */
  public function candle(): array
  {
    $getPrice = Http::get("https://api.ratesapi.io/api/latest");
    if ($getPrice->successful()) {
      try {
        $marketPrice = MarketPrice::orderBy("created_at", "desc")->first();
        if ($marketPrice) {
          $idr = $getPrice->json()["rates"]["IDR"] / $getPrice->json()["rates"]["USD"];
          return [
            "index" => 100,
            "buy" => round($marketPrice->buy / $idr, 8),
            "sell" => round($marketPrice->sell / $idr, 8),
            "last" => round($marketPrice->last / $idr, 8),
            "high" => round($marketPrice->high / $idr, 8),
            "low" => round($marketPrice->low / $idr, 8),
          ];
        }
      } catch (HttpException $e) {
        Log::error($e);
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
