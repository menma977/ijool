<?php

namespace App\Console\Commands;

use App\Http\Controllers\IndodaxController;
use App\Models\MarketPrice;
use App\Models\SettingSubscribe;
use Illuminate\Console\Command;

class UpdateMarketPrice extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'minute:price';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Update market price';

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    $price = IndodaxController::price();
    if ($price->code === 200) {
      $sizeMarketPrice = MarketPrice::count();
      if ($sizeMarketPrice >= 50) {
        MarketPrice::orderBy("created_at", "asc")->first()->delete();
      }

      $marketPrice = new MarketPrice();
      $marketPrice->high = $price->data->high;
      $marketPrice->low = $price->data->low;
      $marketPrice->buy = $price->data->buy;
      $marketPrice->sell = $price->data->sell;
      $marketPrice->last = $price->data->last;
      $marketPrice->save();

      $settingSubscribe = SettingSubscribe::find(1);
      $settingSubscribe->price = round(($settingSubscribe->idr / $price->data->buy) * 10 ** 8);
      $settingSubscribe->save();
    }
  }
}
