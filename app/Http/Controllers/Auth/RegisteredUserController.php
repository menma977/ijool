<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageController;
use App\Models\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
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
    return view('auth.register');
  }

  /**
   * Handle an incoming registration request.
   *
   * @param Request $request
   * @return RedirectResponse
   *
   */
  public function store(Request $request): RedirectResponse
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'code' => 'required|string|min:6|unique:users',
      'username' => 'required|string|max:255|unique:users',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|confirmed|min:6',
      'city' => 'required|string',
      'country' => 'required|string',
      'image' => 'nullable|string|min:6',
    ]);

    $user = new User();
    $user->name = $request->input("name");
    $user->code = $request->input("code");
    $user->username = $request->input("username");
    $user->email = $request->input("email");
    $user->password = Hash::make($request->input("password"));
    $user->save();

    $profile = new Profile();
    $profile->user_id = $user->id;
    $profile->city = $request->input("city");
    $profile->country = $request->input("country");

    if ($request->has("image")) {
      $imageName = Str::uuid() . "." . $request->input("image")->extension();
      $profile->image = $imageName;
      ImageController::profile($request->input("image"), $imageName);
    }
    $profile->save();

    event(new Registered($user));

    return redirect(RouteServiceProvider::HOME);
  }
}
