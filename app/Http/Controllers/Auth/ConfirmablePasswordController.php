<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
  /**
   * Show the confirm password view.
   *
   * @param Request $request
   * @return Application|Factory|\Illuminate\Contracts\View\View|View
   */
  public function show(Request $request)
  {
    return view('auth.confirm-password');
  }

  /**
   * Confirm the user's password.
   *
   * @param Request $request
   * @return mixed
   * @throws ValidationException
   */
  public function store(Request $request)
  {
    if (!Auth::guard('web')->validate([
      'email' => $request->user()->email,
      'password' => $request->password ?? null,
    ])) {
      throw ValidationException::withMessages([
        'password' => __('auth.password'),
      ]);
    }

    $request->session()->put('auth.password_confirmed_at', time());

    return redirect()->intended(RouteServiceProvider::HOME);
  }
}
