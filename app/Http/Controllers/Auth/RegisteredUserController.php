<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DogeController;
use App\Http\Controllers\ImageController;
use App\Models\Doge;
use App\Models\Line;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\Role;
use App\Models\Trading;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
  /**
   * Display the registration view.
   *
   * @return Application|Factory|\Illuminate\Contracts\View\View|View
   */
  public function create()
  {
    return view("auth.register");
  }

  /**
   * Display the registration view.
   *
   * @param $voucher
   * @return Application|Factory|\Illuminate\Contracts\View\View|View
   */
  public function createWithVoucher($voucher)
  {
    $data = [
      "voucher" => $voucher
    ];
    return view("auth.register-voucher", $data);
  }

  /**
   * Handle an incoming registration request.
   *
   * @param Request $request
   * @return RedirectResponse
   *
   * @throws Exception
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      "voucher" => "nullable|string|max:255|exists:users,code",
      "name" => "required|string|max:255",
      "code" => "required|string|min:6|unique:users",
      "username" => "required|string|max:255|unique:users",
      "email" => "required|string|email|max:255|unique:users",
      "password" => "required|string|confirmed|min:6",
      "city" => "required|string",
      "country" => "required|string",
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
    $user->code = $request->input("code");
    $user->username = $request->input("username");
    $user->email = $request->input("email");
    $user->password = Hash::make($request->input("password"));
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
    if ($request->has("voucher")) {
      $friend = User::where("code", $request->input("voucher"))->first();
      $line->user_id = $friend->id;
    } else {
      $line->user_id = 1;
    }
    $line->mate = $user->id;
    $line->save();

    $permission = new Permission();
    $permission->user_id = $user->id;
    $permission->role_id = Role::where("name", "Member")->first()->id;
    $permission->save();

    event(new Registered($user));

    return redirect(RouteServiceProvider::HOME);
  }

  /**
   * @return object
   * @throws Exception
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
