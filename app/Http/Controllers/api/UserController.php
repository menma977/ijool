<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Line;
use App\Models\Profile;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Str;

class UserController extends Controller
{
  /**
   * @param null $user
   * @return JsonResponse
   */
  public function profile($user = null): JsonResponse
  {
    if ($user) {
      if (!Gate::allows("Admin")) {
        return response()->json([
          "message" => "Not Allowed"
        ], 405);
      }

      $user = User::where('username', $user)->first();
    } else {
      $user = Auth::user();
    }

    $subscribes = Subscribe::where("user_id", $user->id)->orderBy("created_at", "desc")->take(10)->get();
    $subscribes->map(function ($item) {
      return [
        "created_at" => $item->created_at,
        "expired_at" => $item->expired_at,
        "label" => round($item->price / 10 ** 8, 8) . " DOGE",
      ];
    });

    if (!$user) {
      return response()->json(["message" => "Not Found"], 404);
    }
    $retVal = [
      "name" => $user->name,
      "username" => $user->username,
      "email" => $user->email,
      "created_at" => $user->created_at,
      "image" => $user->profile->image,
      "country" => $user->profile->country,
      "city" => $user->profile->city,
      "subscribes" => $subscribes
    ];
    if (Auth::user()->permission->pluck("role")->where("name", "Admin")->count()) {
      $lines = Line::where("mate", $user->id)->first();
      if ($lines) {
        $retVal = array_merge($retVal, ["up" => User::find($lines->user_id)->username]);
      } else {
        $retVal = array_merge($retVal, ["up" => $user->username]);
      }
    }
    return response()->json($retVal);
  }

  /**
   * @param null $user
   * @return JsonResponse
   */
  public function mates($user = null): JsonResponse
  {
    if ($user) {
      if (!Auth::user()->permission->pluck("role")->where("name", "Admin")->count()) {
        return response()->json([
          "message" => "Not Allowed"
        ], 405);
      }

      $user = User::where('username', $user)->first();
    } else {
      $user = Auth::user();
    }
    if (!$user) {
      return response()->json(["message" => "Not Found"], 404);
    }
    $lines = Line::where("user_id", $user->id)->get();
    $lines = $lines->map(function ($item) {
      $u = User::find($item->mate);
      return [
        "name" => $u->name,
        "username" => $u->username,
        "email" => $u->email,
        "city" => $u->profile->city,
        "country" => $u->profile->country,
        "image" => $u->profile->image,
        "created_at" => $u->created_at
      ];
    });
    return response()->json(["mates" => $lines]);
  }

  /**
   * @param Request $request
   * @param $id
   * @return mixed
   * @throws ValidationException
   */
  public function update(Request $request, $id)
  {
    $id = Crypt::decryptString($id);
    $this->validate($request, [
      "name" => "nullable|string|max:255",
      "city" => "nullable|string",
      "country" => "nullable|string",
      "image" => "nullable|image|mimes:jpg,jpeg,png|max:2000",
      "password" => "nullable|string|confirmed|min:6",
    ]);

    $user = User::find($id);

    if ($request->has("name")) {
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

    return redirect()->json(["profile" => $profile, "name" => $user->name]);
  }
}
