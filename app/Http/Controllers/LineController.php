<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class LineController extends Controller
{
  /**
   * @return Application|Factory|View
   */
  public function index()
  {
    $line = Line::where("user_id", Auth::id())->get();
    $line->map(function ($item) {
      $item->user = User::find($item->mate);

      return $item;
    });

    $data = [
      "line" => $line
    ];
    return view("line.index", $data);
  }

  /**
   * @param $username
   * @return array
   */
  public function show($username): array
  {
    $user = User::where("username", $username)->first();

    $line = Line::where("user_id", $user->id)->get();
    $line->map(function ($item) {
      $item->user = User::find($item->mate);

      return $item;
    });

    return [
      "line" => $line
    ];
  }
}
