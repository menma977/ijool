<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Version;
use Illuminate\Http\JsonResponse;

class VersionController extends Controller
{
  /**
   * @return JsonResponse
   */
  public function index(): JsonResponse
  {
    $version = Version::first();

    return response()->json([
      "maintenance" => $version->maintenance ? true : false,
      "desktop_code" => $version->desktop_code,
      "desktop_name" => $version->desktop_name,
      "apk_code" => $version->apk_code,
      "apk_name" => $version->apk_name,
    ]);
  }
}
