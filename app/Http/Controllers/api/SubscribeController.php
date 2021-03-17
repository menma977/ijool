<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
  /**
   * @return JsonResponse
   */
  public function index(): JsonResponse
  {
    $validateSubscribe = Subscribe::where("is_finished", false)->where("user_id", Auth::id())->where("expired_at", ">=", Carbon::now())->count();
    if ($validateSubscribe) {
      $data = [
        "subscribe" => true,
      ];
      return response()->json($data);
    }

    $data = [
      "subscribe" => false,
      "message" => "Please subscribe or pay your bill",
    ];
    return response()->json($data, 400);
  }
}
