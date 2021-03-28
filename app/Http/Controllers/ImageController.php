<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
      Storage::delete("public/profile/" . $oldName);
    }
    $imageResize = Image::make($image)->fit(300)->encode();
    Storage::put("public/profile/$name", $imageResize);
  }
}
