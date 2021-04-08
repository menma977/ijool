<?php

namespace App\Http\Controllers;

use App\Models\Doge;
use App\Models\Line;
use App\Models\Profile;
use App\Models\Subscribe;
use App\Models\Trading;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
  public function create()
  {

  }

  /**
   * @return Application|Factory|View
   */
  public function profile()
  {
    $user = User::find(Auth::id());
    $subscribe = Subscribe::where("user_id", $user->id)->orderBy("created_at", "desc")->take(10)->get();
    $subscribe->map(function ($item) {
      if ($item->is_finished) {
        $item->progress = 0;
      } else {
        $item->progress = round((Carbon::parse($item->expired_at)->diffInDays(Carbon::now()) / 30) * 100, 2);
      }
      $item->label = round($item->price / 10 ** 8, 8) . " DOGE";

      return $item;
    });

    $lines = Line::where("user_id", $user->id)->get();
    $lines->map(function ($item) {
      $item->user = User::find($item->mate);

      return $item;
    });

    $data = [
      "user" => $user,
      "subscribe" => $subscribe,
      "lines" => $lines,
    ];
    return view("user.show", $data);
  }

  /**
   * @param $id
   * @return Application|Factory|View
   */
  public function edit($id)
  {
    $id = Crypt::decryptString($id);
    $user = User::find($id);
    $profile = Profile::where("user_id", $user->id)->first();

    $data = [
      "user" => $user,
      "profile" => $profile,
    ];

    return view("user.edit", $data);
  }

  /**
   * @param Request $request
   * @param $id
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request, $id): RedirectResponse
  {
    $id = Crypt::decryptString($id);
    $this->validate($request, [
      "name" => "nullable|string|max:255",
      "city" => "nullable|string",
      "country" => "nullable|string",
      "image" => "nullable|image|mimes:jpg,jpeg,png|max:2000",
      "password" => "nullable|string|confirmed|min:6",
    ]);

    if ($request->has("name")) {
      $user = User::find($id);
      $user->name = $request->input("name");
      $user->save();
    }

    $profile = Profile::where("user_id", $id)->first();
    if ($request->has("city")) {
      $profile->city = $request->input("city");
    }

    if ($request->has("country")) {
      $profile->country = $request->input("country");
    }

    if ($request->hasFile("image")) {
      $imageName = Str::uuid();
      ImageController::profile($request->file("image"), $imageName, $profile->image);
      $profile->image = $imageName;
    }
    $profile->save();

    return redirect()->back()->with(["message" => "Your account has been updated"]);
  }

  /**
   * @param $id
   * @return JsonResponse
   */
  public function getDogeBalance($id): JsonResponse
  {
    $id = Crypt::decryptString($id);
    $doge = Doge::where("user_id", $id)->first();

    if (!$doge->cookie) {
      $login = DogeController::login($doge->username, $doge->password);
      if ($login->code < 400) {
        $doge->cookie = $login->data->cookie;
        $doge->save();
      } else {
        return response()->json([
          "message" => "failed load cookie"
        ], 500);
      }
    }

    $balanceDoge = DogeController::balance($doge->cookie);
    if ($balanceDoge->code < 400) {
      return response()->json([
        "message" => "success!",
        "balance" => round($balanceDoge->data->balance / 10 ** 8, 8)
      ]);
    }

    return response()->json([
      "message" => "failed load balance"
    ], 500);
  }

  /**
   * @param $id
   * @return JsonResponse
   */
  public function getTradingBalance($id): JsonResponse
  {
    $id = Crypt::decryptString($id);
    $treading = Trading::where("user_id", $id)->first();

    if (!$treading->cookie) {
      $login = DogeController::login($treading->username, $treading->password);
      if ($login->code < 400) {
        $treading->cookie = $login->data->cookie;
        $treading->save();
      } else {
        return response()->json([
          "message" => "failed load cookie"
        ], 500);
      }
    }

    $balanceBot = DogeController::balance($treading->cookie);
    if ($balanceBot->code < 400) {
      return response()->json([
        "message" => "success!",
        "balance" => round($balanceBot->data->balance / 10 ** 8, 8)
      ]);
    }

    return response()->json([
      "message" => "failed load balance"
    ], 500);
  }
}
