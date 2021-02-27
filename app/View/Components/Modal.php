<?php

namespace App\View\Components;

use App\Models\Line;
use App\Models\SettingSubscribe;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Modal extends Component
{
  /**
   * Get the view / contents that represent the component.
   *
   * @return View|string
   */
  public function render()
  {
    $line = Line::where("mate", Auth::id())->count();
    $settingSubscribe = SettingSubscribe::first();
    $price = $line ? $settingSubscribe->discount_price : $settingSubscribe->price;

    $data = [
      "price" => round($price / 10 ** 8, 8),
    ];
    return view('components.modal', $data);
  }
}
