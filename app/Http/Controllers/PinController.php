<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class PinController extends Controller
{
  public function index()
  {
    $user_id = Auth::id();
    $totalPin = Pin::total($user_id);
    if (Gate::allows("Admin")) {
      $pins = Pin::orderBy("created_at", "desc")->simplePaginate(20);
    } else {
      $pins = Pin::where("user_id", $user_id)->orderBy("created_at", "desc")->simplePaginate(20);
    }

    $data = [
      "totalPin" => $totalPin,
      "pins" => $pins,
    ];

    return view("pin.index", $data);
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $user = Auth::user();
    $totalPin = Pin::total($user->id);
    $this->validate($request, [
      "username" => "required|string|exists:users,username",
      "amount" => "required|integer|min:1|max:$totalPin",
    ]);

    $receiver = User::where("username", $request->input("username"))->first();

    self::setPin($user, $receiver, $request->input("amount"));

    return redirect()->back()->with(["message" => $request->input("amount") . " pin has been send to " . $request->input("username")]);
  }

  /**
   * @param $send
   * @param $receiver
   * @param $total
   */
  public static function setPin($send, $receiver, $total)
  {
    $pin = new Pin();
    $pin->user_id = $receiver->id;
    $pin->description = $total . " pin has been send from " . $send->username;
    $pin->debit = $total;
    $pin->save();

    $pin = new Pin();
    $pin->user_id = $send->id;
    $pin->description = $total . " pin has been send to " . $receiver->username;
    $pin->credit = $total;
    $pin->save();
  }

  public static function usePin($user_id, $username)
  {
    $pin = new Pin();
    $pin->user_id = $user_id;
    $pin->description = "1 pin has been use to register " . $username;
    $pin->credit = 1;
    $pin->save();
  }
}
