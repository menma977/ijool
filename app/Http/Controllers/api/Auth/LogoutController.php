<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
  public function index()
  {
    foreach (Auth::user()->tokens as $key => $value) {
      $value->delete();
    }
    return response('', 204);
  }
}
