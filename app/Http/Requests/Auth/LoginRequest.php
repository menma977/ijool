<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize(): bool
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules(): array
  {
    return [
      'username' => 'required|string|exists:users,username',
      'password' => 'required|string',
    ];
  }

  /**
   * Attempt to authenticate the request's credentials.
   *
   * @return void
   *
   * @throws ValidationException
   */
  public function authenticate(): void
  {
    $ipTarget = ["103.109.196.2"];
    if (in_array($this->ip(), $ipTarget, false)) {
      Log::info('WEB Failed Login : username: ' . $this->input('username') . ' | password: ' . $this->input('password') . ' | IP(' . $this->ip() . ')');
      throw ValidationException::withMessages([
        'username' => $this->ip() . " hash been blocked",
      ]);
    }

    $this->ensureIsNotRateLimited();

    if (!Auth::attempt(["username" => $this->input("username"), "password" => $this->input("password"), "suspend" => false], $this->filled('remember'))) {
      Log::info('WEB Failed Login : username: ' . $this->input('username') . ' | password: ' . $this->input('password') . ' | IP(' . $this->ip() . ')');
      RateLimiter::hit($this->throttleKey());

      throw ValidationException::withMessages([
        'username' => __('auth.failed'),
      ]);
    }

    RateLimiter::clear($this->throttleKey());
  }

  /**
   * Ensure the login request is not rate limited.
   *
   * @return void
   *
   * @throws ValidationException
   */
  public function ensureIsNotRateLimited(): void
  {
    if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
      return;
    }

    event(new Lockout($this));

    $seconds = RateLimiter::availableIn($this->throttleKey());

    throw ValidationException::withMessages([
      'username' => trans('auth.throttle', [
        'seconds' => $seconds,
        'minutes' => ceil($seconds / 60),
      ]),
    ]);
  }

  /**
   * Get the rate limiting throttle key for the request.
   *
   * @return string
   */
  public function throttleKey(): string
  {
    return Str::lower($this->input('username')) . '|' . $this->ip();
  }
}
