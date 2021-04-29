<?php

namespace App\Http\Controllers;

use App\Models\Doge;
use App\Models\Line;
use App\Models\Permission;
use App\Models\Pin;
use App\Models\Profile;
use App\Models\Role;
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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
  public function index()
  {
    $users = User::simplePaginate(50);

    $data = [
      "users" => $users
    ];

    return view("user.index", $data);
  }

  /**
   * @return Application|Factory|View
   */
  public function create()
  {
    $totalPin = Pin::total(Auth::id());

    $data = [
      "totalPin" => $totalPin
    ];

    return view("user.create", $data);
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   */
  public function store(Request $request): RedirectResponse
  {
    if (Pin::total(Auth::id()) < 1) {
      return back()->with(["error" => "Insufficient Pin"]);
    }
    $request->validate([
      "name" => "required|string|max:255",
      "username" => "required|string|max:255|unique:users",
      "email" => "required|string|email|max:255|unique:users",
      "password" => "required|string|confirmed|min:6",
      "city" => "nullable|string",
      "country" => "nullable|string",
      "image" => "nullable|image|mimes:jpg,jpeg,png|max:2000",
    ]);

    $dogeAccount = $this->makeCoin();
    if ($dogeAccount->code >= 400) {
      return back()->with(["error" => $dogeAccount->message]);
    }

    $tradingAccount = $this->makeCoin();
    if ($tradingAccount->code >= 400) {
      return back()->with(["error" => $tradingAccount->message]);
    }

    $user = new User();
    $user->name = $request->input("name");
    $user->code = $request->input("username");
    $user->username = $request->input("username");
    $user->email = $request->input("email");
    $user->password = Hash::make($request->input("password"));
    $user->email_verified_at = Carbon::now();
    $user->save();

    $doge = new Doge();
    $doge->user_id = $user->id;
    $doge->username = $dogeAccount->data->username;
    $doge->password = $dogeAccount->data->password;
    $doge->wallet = $dogeAccount->data->wallet;
    $doge->cookie = $dogeAccount->data->cookie;
    $doge->Save();

    $trading = new Trading();
    $trading->user_id = $user->id;
    $trading->username = $tradingAccount->data->username;
    $trading->password = $tradingAccount->data->password;
    $trading->wallet = $tradingAccount->data->wallet;
    $trading->cookie = $tradingAccount->data->cookie;
    $trading->Save();

    $profile = new Profile();
    $profile->user_id = $user->id;
    $profile->city = $request->input("city");
    $profile->country = $request->input("country");

    if ($request->has("image")) {
      $imageName = Str::uuid();
      $profile->image = $imageName;
      ImageController::profile($request->file("image"), $imageName);
    }
    $profile->save();

    $line = new Line();
    $line->user_id = Auth::id();
    $line->mate = $user->id;
    $line->is_verified = true;
    $line->save();
    PinController::usePin(Auth::id(), $user->username);

    $permission = new Permission();
    $permission->user_id = $user->id;
    $permission->role_id = Role::where("name", "Member")->first()->id;
    $permission->save();

    $user->sendEmailVerificationNotification();

    return redirect()->back()->with(["message" => "user has been registered"]);
  }

  /**
   * @return Application|Factory|View
   */
  public function profile($id = null)
  {
    if ($id) {
      $user = User::find($id);
    } else {
      $user = User::find(Auth::id());
    }
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

  /**
   * @return object
   */
  private function makeCoin(): object
  {
    $accountCookie = DogeController::createAccount();
    if ($accountCookie->code >= 400) {
      return (object)[
        "code" => 500,
        "message" => $accountCookie->message,
        "data" => []
      ];
    }

    $accountWallet = DogeController::wallet($accountCookie->data->cookie);
    if ($accountWallet->code >= 400) {
      return (object)[
        "code" => 500,
        "message" => $accountWallet->message,
        "data" => []
      ];
    }

    $usernameCoin = DogeController::randomAccount();
    $passwordCoin = DogeController::randomAccount();

    $createUser = DogeController::createUser($accountCookie->data->cookie, $usernameCoin, $passwordCoin);
    if ($createUser->code >= 400) {
      return (object)[
        "code" => 500,
        "message" => $createUser->message,
        "data" => []
      ];
    }

    return (object)[
      "code" => 200,
      "message" => "successfully created",
      "data" => (object)[
        "username" => $usernameCoin,
        "password" => $passwordCoin,
        "wallet" => $accountWallet->data->wallet,
        "cookie" => $accountCookie->data->cookie,
      ]
    ];
  }
}
