<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
  /**
   * Get the view / contents that represent the component.
   *
   * @return View|string
   */
  public function render()
  {
    $user = Auth::user();

    $data = [
      "user" => $user,
    ];
    return view('components.header', $data);
  }
}
