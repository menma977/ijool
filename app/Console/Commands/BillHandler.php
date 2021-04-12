<?php

namespace App\Console\Commands;

use App\Http\Controllers\DogeController;
use App\Models\Bank;
use App\Models\Bill;
use App\Models\Doge;
use App\Models\Line;
use App\Models\Queue;
use App\Models\SettingSubscribe;
use App\Models\Subscribe;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BillHandler extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = "minute:bill";

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = "Command description";

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    $bill = Bill::where("status", false)->where("send_at", "<=", Carbon::now())->first();
    if ($bill) {
      $doge = Doge::where("user_id", $bill->from)->first();
      $settingSubscribe = SettingSubscribe::first();
      $line = Line::where("mate", $bill->user_id)->whereNotIn("user_id", [1])->count();

      $withdraw = DogeController::withdraw($doge->cookie, Bank::first()->wallet, $bill->value);
      if ($withdraw->code < 400) {
        $value = $bill->value;
        if ($line) {
          $shareQueue = new Queue();
          $shareQueue->from = $bill->from;
          $shareQueue->to = Line::where("mate", $bill->from)->first()->user_id ?? 1;
          $shareQueue->value = round($value * $settingSubscribe->share);
          $shareQueue->save();
          $value -= $shareQueue->value;
        }

        $bankQueue = new Queue();
        $bankQueue->from = $bill->from;
        $bankQueue->to = 1;
        $bankQueue->value = $value;
        $bankQueue->save();

        $subscribe = new Subscribe();
        $subscribe->user_id = $bill->from;
        $subscribe->price = $bill->value;
        $subscribe->is_finished = false;
        $subscribe->expired_at = Carbon::now()->addMonth();
        $subscribe->save();

        $bill->status = true;
      } else {
        $bill->send_at = Carbon::now()->addMinutes(10)->format("Y-m-d H:i:s");
      }
      $bill->save();
    }

    $removeBill = Bill::where("status", false)->where("created_at", "<", Carbon::now()->addDays(-6))->first();
    if ($removeBill) {
      $user = User::find($removeBill->from);
      $user->subscribe = false;
      $user->Save();

      $removeBill->delete();
    }
  }
}
