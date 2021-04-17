<?php

namespace App\View\Components;

use App\Models\SettingSubscribe;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
  /**
   * Get the view / contents that represent the component.
   *
   * @return View
   */
  public function render(): View
  {
    $settingSubscribe = SettingSubscribe::first();

    $targetMin = 1000000000;
    if ($settingSubscribe->price < $targetMin) {
      $price = $targetMin;
    } else {
      $price = $settingSubscribe->price;
    }

    $data = [
      "price" => round($price / 10 ** 8, 8),
    ];
    return view('components.modal', $data);
  }
}
