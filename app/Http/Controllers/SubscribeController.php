<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Doge;
use App\Models\Line;
use App\Models\Queue;
use App\Models\SettingSubscribe;
use App\Models\Subscribe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SubscribeController extends Controller
{
  /**
   * @return RedirectResponse
   */
  public function subscribe(): RedirectResponse
  {

    $user = User::find(Auth::id());
    if ($user->subscribe) {
      $user->subscribe = false;
      $user->save();
      Subscribe::where('is_finished', false)->update(["is_finished" => true]);
      return back()->with(["warning" => "Your subscription has been stopped."]);
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
    $line = Line::where("mate", Auth::id())->whereNotIn("user_id", [1])->count();
    $settingSubscribe = SettingSubscribe::first();
    if ($doge->cookie && Carbon::parse($doge->updated_at)->diffInMonths(Carbon::now()) < 1) {
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

    Log::info("Price: " . $price);
    if ($balance >= $price) {
      $code = 200;
      if ($price != 0) {
        $withdraw = DogeController::withdraw($doge->cookie, Bank::first()->wallet, $price);
        $code = $withdraw->code;
        if ($code == 200) {
          $value = $price;
          if ($line) {
            $shareQueue = new Queue();
            $shareQueue->from = $user->id;
            $shareQueue->to = Line::where("mate", $user->id)->first()->user_id ?? 1;
            $shareQueue->value = round($value * $settingSubscribe->share);
            $shareQueue->save();
            $value -= $shareQueue->value;
          }

          $bankQueue = new Queue();
          $bankQueue->from = $user->id;
          $bankQueue->to = 1;
          $bankQueue->value = $value;
          $bankQueue->save();
        } else {
          return (object)[
            "code" => 400,
            "message" => $withdraw->message,
          ];
        }
      }

      if (($code == 200 && $price > 0) || $price <= 0) {
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
        "code" => 500,
        "message" => "something wrong",
      ];
    }

    return (object)[
      "code" => 400,
      "message" => "Insufficient fund need deposit first. your balance is " . round($balance / 10 ** 8, 8) . " DOGE",
    ];
  }
}
