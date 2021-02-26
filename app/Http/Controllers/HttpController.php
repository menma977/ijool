<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HttpController extends Controller
{
  static private $key = "98a1783c323940e193acfbf7ff4b0aa2";

  /**
   * @param $action
   * @param $body
   * @param false $needKey
   * @return object
   */
  public static function post($action, $body, $needKey = false): object
  {
    $body["a"] = $action;
    if ($needKey) {
      $body["Key"] = self::$key;
    }
    $post = Http::asForm()->post("https://www.999doge.com/api/web.aspx", $body);

    switch ($post) {
      case $post->serverError():
        $data = [
          'code' => 500,
          'message' => 'server error code 500',
          'data' => [],
        ];
        break;
      case $post->clientError():
        $data = [
          'code' => 401,
          'message' => 'client error code 401',
          'data' => [],
        ];
        break;
      case $post->status() === 408:
        $data = [
          'code' => 408,
          'message' => 'Timeout',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'IP are blocked for 2 minutes.') === true:
        $data = [
          'code' => 500,
          'message' => 'server has been blocked',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'ChanceTooHigh') === true:
        $data = [
          'code' => 400,
          'message' => 'Chance Too High',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'ChanceTooLow') === true:
        $data = [
          'code' => 400,
          'message' => 'Chance Too Low',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'InsufficientFunds') === true:
        $data = [
          'code' => 400,
          'message' => 'Insufficient Funds',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'NoPossibleProfit') === true:
        $data = [
          'code' => 400,
          'message' => 'No Possible Profit',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'MaxPayoutExceeded') === true:
        $data = [
          'code' => 400,
          'message' => 'Max Payout Exceeded',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), '999doge') === true:
        $data = [
          'code' => 400,
          'message' => 'Invalid request On Server Wait 5 minute to try again',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'error') === true:
        $data = [
          'code' => 400,
          'message' => 'Invalid request',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'TooFast') === true:
        $data = [
          'code' => 400,
          'message' => 'Too Fast',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'TooSmall') === true:
        $data = [
          'code' => 400,
          'message' => 'Too Small',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'LoginRequired') === true:
        $data = [
          'code' => 400,
          'message' => 'Login Required',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'InvalidApiKey') === true:
        $data = [
          'code' => 400,
          'message' => 'key you provided is invalid',
          'data' => [],
        ];
        break;
      case str_contains($post->body(), 'error ') === true:
        $data = [
          'code' => 400,
          'message' => 'Party Error',
          'data' => [],
        ];
        break;
      default:
        $data = [
          'code' => 200,
          'message' => 'successful',
          'data' => (object)$post->json(),
        ];
        break;
    }

    return (object)$data;
  }
}
