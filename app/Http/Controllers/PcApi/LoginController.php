<?php

namespace App\Http\Controllers\PcApi;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DogeController;
use App\Models\Doge;
use App\Models\Subscribe;
use App\Models\Trading;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
  public function pc_login(Request $request): JsonResponse
  {
    $this->validate($request, [
      "username" => "required|string|exists:users,username",
      "password" => "required|string"
    ]);

    try {
      if (Auth::attempt(["username" => $request->input("username"), "password" => $request->input("password")])) {
        foreach (Auth::user()->tokens as $id => $item) {
          $item->delete();
        }
        /** @var \App\Models\User */
        $user = Auth::user();
        if ($user) {
          $doge = Doge::where("user_id", $user->id)->first();
          $bot = Trading::where("user_id", $user->id)->first();
          $subscribe = Subscribe::where("user_id", $user->id)->where("is_finished", false)->count();

          if ($user->suspend) {
            return response()->json(["message" => "your account has been suspended"], 500);
          }

          if (Carbon::parse($doge->updated_at)->diffInDays(Carbon::now()) >= 30 || !$doge->cookie) {
            $getDogeCookie = self::updateCookie($doge->username, $doge->password);
            if ($getDogeCookie->code < 400) {
              $doge->cookie = $getDogeCookie->cookie;
              $doge->Save();
            } else {
              return response()->json(["message" => $getDogeCookie->message], $getDogeCookie->code);
            }
          }

          if (Carbon::parse($bot->updated_at)->diffInDays(Carbon::now()) >= 30 || !$bot->cookie) {
            $getDogeCookie = self::updateCookie($bot->username, $bot->password);
            if ($getDogeCookie->code < 400) {
              $bot->cookie = $getDogeCookie->cookie;
              $bot->Save();
            } else {
              return response()->json(["message" => $getDogeCookie->message], $getDogeCookie->code);
            }
          }

          $user->token = $user->createToken("Pc")->accessToken;

          return response()->json([
            "token" => $user->token,
            "username" => $user->username,
            "email" => $user->email,
            "name" => $user->name,
            "code" => $user->code,
            "roles" => $user->permission->pluck("role")->pluck("name"),
            "is_subscribe" => $subscribe ? Subscribe::where("user_id", $user->id)->select("expired_at")->orderBy("expired_at", "DESC")->first()->expired_at : false,
            "account_active" => !$user->email_verified_at ? false : true,
            "cookie_doge" => $doge->cookie,
            "wallet_doge" => $doge->wallet,
            "cookie_bot" => $bot->cookie,
            "wallet_bot" => $bot->wallet,
            "join_date" => $user->created_at
          ]);
        }
        return response()->json(["message" => "CODE:401 - user is invalid."], 401);
      }
      return response()->json(["message" => "Invalid username and password."], 500);
    } catch (Exception $e) {
      Log::error($e->getMessage() . " - " . $e->getFile() . " - " . $e->getLine());
      $data = [
        "message" => $e->getMessage(),
      ];
      return response()->json($data, 500);
    }
  }

  /**
   * @param $username
   * @param $password
   * @return object
   */
  private static function updateCookie($username, $password): object
  {
    $doge = DogeController::login($username, $password);

    return (object)[
      "code" => $doge->code,
      "message" => $doge->message,
      "cookie" => $doge->data->cookie ?? ""
    ];
  }
}
