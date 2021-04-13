<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DogeController;
use App\Models\Doge;
use App\Models\Subscribe;
use App\Models\Trading;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
  /**
   * @param Request $request
   * @return JsonResponse
   * @throws ValidationException
   */
  public function index(Request $request): JsonResponse
  {
    $ipTarget = ["103.109.196.2"];
    if (in_array($request->ip(), $ipTarget, false)) {
      Log::info('APK block try to Login : username: ' . $request->input('username') . ' | password: ' . $request->input('password') . ' | IP(' . $request->ip() . ')');
      return response()->json(["message" => $request->ip() . " hash been blocked"], 500);
    }

    $this->validate($request, [
      "username" => "required|string|exists:users,username",
      "password" => "required|string"
    ]);

    try {
      if (Auth::attempt(["username" => $request->input("username"), "password" => $request->input("password")])) {
        foreach (Auth::user()->tokens as $item) {
          $item->delete();
        }
        $user = Auth::user();
        if ($user) {
          $doge = Doge::where("user_id", $user->id)->first();
          $bot = Trading::where("user_id", $user->id)->first();
          $subscribe = Subscribe::where("user_id", $user->id)->where("is_finished", false)->count();

          if (!$subscribe) {
            return response()->json(["message" => "please subscribe or pay your bill"], 500);
          }

          if ($user->suspend) {
            return response()->json(["message" => "your account has been suspended"], 500);
          }

          if (!$user->email_verified_at) {
            return response()->json(["message" => "your account is not active. please active your account."], 500);
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

          $user->token = $user->createToken("Android")->accessToken;

          Log::info('APK username: ' . $request->input('username') . ' | password: ' . $request->input('password') . ' | IP(' . $request->ip() . ')');

          return response()->json([
            "token" => $user->token,
            "username" => $user->username,
            "email" => $user->email,
            "name" => $user->name,
            "code" => $user->code,
            "roles" => $user->permission->pluck("role")->pluck("name"),
            "is_subscribe" => Subscribe::where("user_id", $user->id)->select("expired_at")->orderBy("expired_at", "DESC")->first()->expired_at,
            "cookie_doge" => $doge->cookie,
            "wallet_doge" => $doge->wallet,
            "cookie_bot" => $bot->cookie,
            "wallet_bot" => $bot->wallet,
          ]);
        }
        return response()->json(["message" => "CODE:401 - user is invalid."], 401);
      }

      Log::info('APK Failed Login : username: ' . $request->input('username') . ' | password: ' . $request->input('password') . ' | IP(' . $request->ip() . ')');
      return response()->json(["message" => "Invalid username and password."], 500);
    } catch (Exception $e) {
      Log::info('APK Failed Login : username: ' . $request->input('username') . ' | password: ' . $request->input('password') . ' | IP(' . $request->ip() . ')');
      Log::error($e->getMessage() . " - " . $e->getFile() . " - " . $e->getLine());
      $data = [
        "message" => $e->getMessage(),
      ];
      return response()->json($data, 500);
    }
  }

  /**
   * @return JsonResponse
   */
  public function check(): JsonResponse
  {
    $data = [
      "auth" => Auth::check(),
    ];
    return response()->json($data);
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
