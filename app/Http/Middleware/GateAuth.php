<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GateAuth
{
  /**
   * Handle an incoming request.
   *
   * @param Request $request
   * @param Closure $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    if (auth()->check()) {
      $permissions = Permission::all();
      $permissionArray = [];

      foreach ($permissions as $permission) {
        $permissionArray[$permission->role->name][] = $permission->role_id;
      }

      foreach ($permissionArray as $title => $roles) {
        Gate::define($title, function ($user) use ($roles) {
          return count(array_intersect($user->permission->pluck("role_id")->toArray(), $roles)) > 0;
        });
      }
    }

    return $next($request);
  }
}
