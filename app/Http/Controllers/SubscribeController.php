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

class SubscribeController extends Controller
{
  /**
   * @return RedirectResponse
   */
  public function subscribe($type): RedirectResponse
  {
    $user = User::find(Auth::id());
    if ($type == "subscribe") {
      if (Subscribe::where("user_id", $user->id)->where('is_finished', true)->count()) {
        $onSubscribe = self::onSubscribe($user);
        if ($onSubscribe->code == 200) {
          $user->subscribe = true;
          $user->save();
          return back()->with(["message" => $onSubscribe->message]);
        }
        return back()->with(["error" => $onSubscribe->message]);
      } else {
        return back()->with(["warning" => "you have been subscribed to our features"]);
      }
    } else {
      $user->subscribe = false;
      $user->save();
      Subscribe::where("user_id", $user->id)->where('is_finished', false)->update(["is_finished" => true]);
      return back()->with(["warning" => "Your subscription has been stopped."]);
    }
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

    if ($balance >= $settingSubscribe->price) {
      $withdraw = DogeController::withdraw($doge->cookie, Bank::first()->wallet, $settingSubscribe->price);
      $code = $withdraw->code;
      if ($code == 200) {
        $value = $settingSubscribe->price;
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

        $user->subscribe = true;
        $user->save();

        $subscribe = new Subscribe();
        $subscribe->user_id = $user->id;
        $subscribe->price = $settingSubscribe->price;
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
        "message" => $withdraw->message,
      ];
    }

    return (object)[
      "code" => 400,
      "message" => "Insufficient fund need deposit first. your balance is " . round($balance / 10 ** 8, 8) . " DOGE",
    ];
  }
}
