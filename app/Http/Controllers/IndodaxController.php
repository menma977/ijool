<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Exception;

class IndodaxController extends Controller
{
  /**
   * @return object
   */
  public static function price(): object
  {
    try {
      $get = Http::get("https://indodax.com/api/ticker/dogeidr");

      switch ($get) {
        case $get->serverError():
          $data = [
            'code' => 500,
            'message' => 'server error code 500',
            'data' => [],
          ];
          break;
        case $get->clientError():
          $data = [
            'code' => 401,
            'message' => 'client error code 401',
            'data' => [],
          ];
          break;
        case $get->status() === 408:
          $data = [
            'code' => 408,
            'message' => 'Timeout',
            'data' => [],
          ];
          break;
        case str_contains($get->body(), 'error') === true:
          $data = [
            'code' => 400,
            'message' => 'Invalid request',
            'data' => [],
          ];
          break;
        default:
          $data = [
            'code' => 200,
            'message' => 'successful',
            'data' => (object)$get->json()["ticker"],
          ];
          break;
      }

      return (object)$data;
    } catch (Exception $e) {
      return (object)[
        "code" => 408,
        'message' => 'Timeout',
        'data' => [],
      ];
    }
  }
}
