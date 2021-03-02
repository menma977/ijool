<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Line;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
  /**
   * Mark the authenticated user's email address as verified.
   *
   * @param $id
   * @param $hash
   * @return RedirectResponse
   * @throws AuthorizationException
   */
  public function __invoke($id, $hash): RedirectResponse
  {
    $user = User::find($id);
    if (!hash_equals((string)$hash, sha1($user->getEmailForVerification()))) {
      throw new AuthorizationException;
    }

    if ($user->markEmailAsVerified()) {
      event(new Verified($user));
    }

    $line = Line::where("mate", $user->id)->first();
    if ($line) {
      $line->is_verified = true;
      $line->Save();
    }

    Auth::login($user);

    return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
  }
}
