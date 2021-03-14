<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
  /**
   * @return JsonResponse
   */
  public function index(): JsonResponse
  {
    foreach (Auth::user()->tokens as $key => $value) {
      $value->delete();
    }
    $data = [
      "message" => "user logout",
    ];
    return response()->json($data, 204);
  }
}
