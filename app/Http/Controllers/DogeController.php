<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Collection;

class DogeController extends Controller
{
  /**
   * @return Collection
   */
  public static function createAccount(): Collection
  {
    $post = HttpController::post("CreateAccount", [], true);
    if ($post->code === 200) {
      return collect([
        "code" => 200,
        "message" => "successfully created account",
        "data" => $post->data->SessionCookie,
      ]);
    }

    return collect([
      "code" => 400,
      "message" => "create account failed. please try again",
      "data" => null,
    ]);
  }

  /**
   * @param $cookie
   * @return Collection
   */
  public static function wallet($cookie): Collection
  {
    $data = [
      "s" => $cookie,
      'Currency' => "doge"
    ];
    $post = HttpController::post("GetDepositAddress", $data, true);
    if ($post->code === 200) {
      return collect([
        "code" => 200,
        "message" => "successfully created wallet",
        "data" => $post->data->Address,
      ]);
    }

    return collect([
      "code" => 400,
      "message" => "create wallet failed. please try again",
      "data" => null,
    ]);
  }

  /**
   * @param $cookie
   * @param $username
   * @param $password
   * @return Collection
   */
  public static function createUser($cookie, $username, $password): Collection
  {
    $data = [
      "s" => $cookie,
      "Username" => $username,
      "Password" => $password,
    ];
    $post = HttpController::post("CreateUser", $data, true);
    if ($post->code === 200) {
      return collect([
        "code" => 200,
        "message" => "successfully created user",
      ]);
    }

    return collect([
      "code" => 400,
      "message" => "create user failed.",
    ]);
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
