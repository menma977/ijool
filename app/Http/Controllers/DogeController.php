<?php

namespace App\Http\Controllers;

use Exception;

class DogeController extends Controller
{
  /**
   * @return object
   */
  public static function createAccount(): object
  {
    $post = HttpController::post("CreateAccount", [], true);
    if ($post->code === 200) {
      return (object)[
        "code" => 200,
        "message" => "successfully created account",
        "data" => (object)[
          "cookie" => $post->data->SessionCookie
        ],
      ];
    }

    return (object)[
      "code" => 400,
      "message" => "create account failed. please try again",
      "data" => [],
    ];
  }

  /**
   * @param $cookie
   * @return object
   */
  public static function wallet($cookie): object
  {
    $data = [
      "s" => $cookie,
      'Currency' => "doge"
    ];
    $post = HttpController::post("GetDepositAddress", $data);
    if ($post->code === 200) {
      return (object)[
        "code" => $post->code,
        "message" => $post->message,
        "data" => (object)[
          "wallet" => $post->data->Address
        ],
      ];
    }

    return (object)[
      "code" => $post->code,
      "message" => $post->message,
      "data" => [],
    ];
  }

  /**
   * @param $cookie
   * @param $username
   * @param $password
   * @return object
   */
  public static function createUser($cookie, $username, $password): object
  {
    $data = [
      "s" => $cookie,
      "Username" => $username,
      "Password" => $password,
    ];
    $post = HttpController::post("CreateUser", $data);
    if ($post->code === 200) {
      return (object)[
        "code" => $post->code,
        "message" => $post->message,
      ];
    }

    return (object)[
      "code" => $post->code,
      "message" => $post->message,
    ];
  }


  /**
   * @param $username
   * @param $password
   * @return object
   */
  public static function login($username, $password): object
  {
    $data = [
      "Username" => $username,
      "Password" => $password,
    ];
    $post = HttpController::post("Login", $data, true);
    if ($post->code === 200) {
      return (object)[
        "code" => $post->code,
        "message" => $post->message,
        "data" => (object)[
          "cookie" => $post->data->SessionCookie,
          "balance" => $post->data->Doge["Balance"],
        ],
      ];
    }

    return (object)[
      "code" => $post->code,
      "message" => $post->message,
      "data" => []
    ];
  }

  /**
   * @param $cookie
   * @return object
   */
  public static function balance($cookie): object
  {
    $data = [
      "s" => $cookie,
      "Currency" => "doge"
    ];
    $post = HttpController::post("GetBalance", $data);
    if ($post->code === 200) {
      return (object)[
        "code" => $post->code,
        "message" => $post->message,
        "data" => (object)[
          "balance" => $post->balance,
        ],
      ];
    }

    return (object)[
      "code" => $post->code,
      "message" => $post->message,
      "data" => [],
    ];
  }

  /**
   * @param int $length
   * @return string
   * @throws Exception
   */
  public static function randomAccount($length = 20): string
  {
    $characters = "0123456789IJOOLijool";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return "IijoolI" . $randomString;
  }
}
