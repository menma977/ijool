<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class SideBar extends Component
{
  /**
   * Get the view / contents that represent the component.
   *
   * @return View
   */
  public function render(): View
  {
    $user = Auth::user();

    $data = [
      "user" => $user,
    ];
    return view('components.side-bar', $data);
  }
}
