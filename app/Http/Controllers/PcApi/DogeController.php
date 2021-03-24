<?php

namespace App\Http\Controllers\PcApi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DogeController as WDoge;
use App\Models\Doge;
use App\Models\Trading;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DogeController extends Controller
{
  /**
   * @param Request $request
   * @param $type
   * @param bool $isAll
   * @return JsonResponse
   * @throws ValidationException
   */
  public function transfer(Request $request, $type, $isAll = false): JsonResponse
  {
    $doge = Doge::where("user_id", Auth::id())->first();
    $bot = Trading::where("user_id", Auth::id())->first();
    if ($type == "bot") {
      if ($isAll) {
        $post = WDoge::withdraw($doge->cookie, $bot->wallet, 0);
      } else {
        $this->validate($request, [
          "amount" => "required|numeric|min:2",
        ]);
        $post = WDoge::withdraw($doge->cookie, $bot->wallet, round($request->amount * 10 ** 8));
      }
    } else if ($isAll) {
      $post = WDoge::withdraw($bot->cookie, $doge->wallet, 0);
    } else {
      $this->validate($request, [
        "amount" => "required|numeric|min:2",
      ]);
      $post = WDoge::withdraw($bot->cookie, $doge->wallet, round($request->amount * 10 ** 8));
    }

    if ($post->code < 400) {
      return response()->json(["message" => $post->message]);
    }

    return response()->json(["message" => $post->message], 400);
  }

  public function withdraw(Request $request): JsonResponse
  {
    $this->validate($request, [
      "amount" => "required|numeric|min:5",
      "wallet" => "required|string"
    ]);
    $doge = Doge::where("user_id", Auth::id())->first();
    if (!$doge->cookie) {
      $login = WDoge::login($doge->username, $doge->password);
      if ($login < 400) {
        $doge->cookie = $login->data->cookie;
        $doge->save();
      } else {
        return redirect()->back()->with(["warning" => $login->message]);
      }
    }
    $validateWalletDoge = Doge::where("wallet", $request->input("wallet"))->count();
    $validateWalletBot = Trading::where("wallet", $request->input("wallet"))->count();
    $fee = 0;
    if (!$validateWalletDoge && !$validateWalletBot) {
      $fee = 3;
      WDoge::withdraw($doge->cookie, User::find(1)->doge->wallet, round($fee * (10 ** 8)));
    }
    $withdraw = WDoge::withdraw($doge->cookie, $request->input("wallet"), round(($request->input("amount") - $fee) * 10 ** 8));
    if ($withdraw->code < 400) {
      return redirect()->json(["message" => $withdraw->message]);
    }

    return redirect()->json(["warning" => $withdraw->message], 400);
  }
}
