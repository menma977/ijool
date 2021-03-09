<?php

namespace App\Http\Controllers;

use App\Models\SettingSubscribe;
use App\Models\Subscribe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SettingSubscribeController extends Controller
{
  /**
   * @return Application|Factory|View
   */
  public function index()
  {
    $subscribes = Subscribe::orderBy("created_at", "desc")->simplePaginate(20);
    $subscribes->getCollection()->transform(function ($subscribe) {
      $subscribe->user = User::find($subscribe->user_id);
      $subscribe->price = round($subscribe->price / 10 ** 8, 8);
      $subscribe->expired_at = Carbon::parse($subscribe->expired_at)->format('d/M/Y');

      return $subscribe;
    });

    $data = [
      "subscribes" => $subscribes,
    ];

    return view("config.subscribe.index", $data);
  }

  /**
   * @return Application|Factory|View
   */
  public function edit()
  {
    $settingSubscribe = SettingSubscribe::first();

    $data = [
      "settingSubscribe" => $settingSubscribe,
    ];
    return view("config.subscribe.edit", $data);
  }

  /**
   * @param Request $request
   * @return RedirectResponse
   * @throws ValidationException
   */
  public function update(Request $request): RedirectResponse
  {
    $this->validate($request, [
      "price" => "required|numeric",
      "share" => "required|numeric|min:1|max:100",
    ]);

    $settingSubscribe = SettingSubscribe::first();
    $settingSubscribe->idr = str_replace(".", "", $request->input("price"));
    $settingSubscribe->share = round($request->input("share") / 100, 2);
    $settingSubscribe->save();

    return redirect()->back()->with(["message" => "Setting subscription updated"]);
  }
}
