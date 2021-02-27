<?php

namespace App\Http\Controllers;

use App\Models\Doge;
use App\Models\Line;
use App\Models\SettingSubscribe;
use App\Models\Subscribe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubscribeController extends Controller
{
  /**
   * @return RedirectResponse
   */
  public function subscribe(): RedirectResponse
  {
//    return back()->with(["error" => "Your subscription has been stopped."]);
    $user = User::find(Auth::id());
    if ($user->subscribe) {
      $user->subscribe = false;
      $user->save();
      Subscribe::where('is_finished', false)->update(["is_finished" => true]);
      return back()->with(["message" => "Your subscription has been stopped."]);
    }

    $onSubscribe = self::onSubscribe($user);
    if ($onSubscribe->code == 200) {
      $user->subscribe = true;
      $user->save();
      return back()->with(["message" => $onSubscribe->message]);
    }

    return back()->with(["error" => $onSubscribe->message]);
  }

  /**
   * @param $user
   * @return object
   */
  public static function onSubscribe($user): object
  {
    $doge = Doge::where("user_id", $user->id)->first();
    $line = Line::where("mate", Auth::id())->count();
    $settingSubscribe = SettingSubscribe::first();
    if ($doge->cookie) {
      $getBalance = DogeController::balance($doge->cookie);
      if ($getBalance->code == 200) {
        $balance = $getBalance->data->balance;
      } else {
        return (object)[
          "code" => $getBalance->code,
          "message" => $getBalance->message,
        ];
      }
    } else {
      $login = DogeController::login($doge->username, $doge->password);
      if ($login->code == 200) {
        $doge->cookie = $login->data->cookie;
        $doge->save();
        $balance = $login->data->balance;
      } else {
        return (object)[
          "code" => $login->code,
          "message" => $login->message,
        ];
      }
    }

    $price = $line ? $settingSubscribe->discount_price : $settingSubscribe->price;

    if ($balance > $price) {
      $user->subscribe = true;
      $user->save();

      $subscribe = new Subscribe();
      $subscribe->user_id = $user->id;
      $subscribe->price = $price;
      $subscribe->is_finished = false;
      $subscribe->expired_at = Carbon::now()->addMonth();
      $subscribe->save();

      return (object)[
        "code" => 200,
        "message" => "Thank you for your subscription",
      ];
    }

    return (object)[
      "code" => 400,
      "message" => "Insufficient fund",
    ];
  }
}
