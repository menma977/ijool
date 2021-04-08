<?php

namespace App\Http\Controllers;

use App\Models\Pin;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PinController extends Controller
{
  public function index()
  {

  }

  /**
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function store(Request $request): RedirectResponse
  {
    $user_id = Auth::id();
    $totalPin = Pin::find($user_id)->total();
    $this->validate($request, [
      "username" => "required|string|exists:users,username",
      "total" => "required|integer|min:1|max:$totalPin",
    ]);

    $receiver = User::where("username", $request->input("username"))->first();

    self::setPin($user_id, $receiver->id, $request->input("total"));

    return redirect()->back()->with(["message" => $request->input("total") . " pin has been send to " . $request->input("username")]);
  }

  /**
   * @param $id
   * @return RedirectResponse
   */
  public function destroy($id): RedirectResponse
  {
    $pin = Pin::find($id);
    $user = User::find($pin->user_id);
    $totalPin = $pin->total();
    $pin->delete();

    return redirect()->back()->with(["message" => $totalPin . " pin has been remove from" . $user->username]);
  }

  /**
   * @param $send
   * @param $receiver
   * @param $total
   */
  public static function setPin($send, $receiver, $total)
  {
    $pin = new Pin();
    $pin->user_id = $receiver;
    $pin->debit = $total;
    $pin->save();

    $pin = new Pin();
    $pin->user_id = $send;
    $pin->credit = $total;
    $pin->save();
  }

  public static function usePin($user_id)
  {
    $pin = new Pin();
    $pin->user_id = $user_id;
    $pin->credit = 1;
    $pin->save();
  }
}
