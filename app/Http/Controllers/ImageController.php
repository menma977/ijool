<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  /**
   * @param $image
   * @param $name
   */
  public static function profile($image, $name): void
  {
    Storage::putFileAs("public/profile", $image, $name, "public");
  }
}
