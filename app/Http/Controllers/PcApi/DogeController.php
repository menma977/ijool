<?php

namespace App\Http\Controllers\PcApi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DogeController as WDoge;
use App\Models\Doge;
use App\Models\Trading;
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
}
