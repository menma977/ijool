<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DogeController;
use App\Models\Bank;
use App\Models\Doge;
use App\Models\Trading;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CoinController extends Controller
{
  /**
   * @param Request $request
   * @return JsonResponse|RedirectResponse
   * @throws ValidationException
   */
  public function withdraw(Request $request)
  {
    $this->validate($request, [
      "amount" => "required|numeric|min:10",
      "wallet" => "required|string"
    ]);
    $doge = Doge::where("user_id", Auth::id())->first();
    if (!$doge->cookie) {
      $login = DogeController::login($doge->username, $doge->password);
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
      if ($request->input("amount") > 500) {
        $fee = $request->input("amount") * 0.02;
      } else {
        $fee = 5;
      }
    }

    $withdraw = DogeController::withdraw($doge->cookie, $request->input("wallet"), round(($request->input("amount") - $fee) * 10 ** 8));
    if ($withdraw->code < 400) {
      $withdrawShare = DogeController::withdraw($doge->cookie, Bank::first()->wallet, round($fee * (10 ** 8)));
      if ($withdrawShare->code < 400) {
        DogeController::share(Auth::id(), round($fee * (10 ** 8)));
      }
      return response()->json([
        "message" => "withdraw on process"
      ]);
    }

    return response()->json([
      "message" => $withdraw->message
    ], $withdraw->code);
  }

  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function transfer(Request $request): JsonResponse
  {
    $this->validate($request, [
      "type" => "required|string|in:bot,doge",
      "all" => "required|numeric|min:0|max:1"
    ]);
    $doge = Doge::where("user_id", Auth::id())->first();
    $bot = Trading::where("user_id", Auth::id())->first();
    if ($request->input("type") == "bot") {
      if ($request->input("all")) {
        $post = DogeController::withdraw($doge->cookie, $bot->wallet, 0);
      } else {
        $this->validate($request, [
          "amount" => "required|numeric|min:2",
        ]);
        $post = DogeController::withdraw($doge->cookie, $bot->wallet, round($request->amount * 10 ** 8));
      }
    } else if ($request->input("all")) {
      $post = DogeController::withdraw($bot->cookie, $doge->wallet, 0);
    } else {
      $this->validate($request, [
        "amount" => "required|numeric|min:2",
      ]);
      $post = DogeController::withdraw($bot->cookie, $doge->wallet, round($request->amount * 10 ** 8));
    }

    if ($post->code < 400) {
      return response()->json([
        "message" => $post->message
      ], $post->code);
    }

    return response()->json([
      "message" => $post->message
    ], $post->code);
  }
}
