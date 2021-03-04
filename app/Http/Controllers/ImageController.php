<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
  /**
   * @param $image
   * @param $name
   * @param null $oldName
   */
  public static function profile($image, $name, $oldName = null): void
  {
    if ($oldName) {
      Storage::delete('public/profile/' . $oldName);
    }
    Storage::putFileAs("public/profile", $image, $name);
  }
}
