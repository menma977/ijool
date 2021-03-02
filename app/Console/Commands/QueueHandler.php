<?php

namespace App\Console\Commands;

use App\Http\Controllers\DogeController;
use App\Models\Bank;
use App\Models\Doge;
use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\Console\Command;

class QueueHandler extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'minute:queue';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Send Balance to target';

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    $queue = Queue::where("status", false)->where("send_at", "<=", Carbon::now())->first();
    if ($queue) {
      $bank = Bank::first();
      $dogeReceiver = Doge::where("user_id", $queue->to)->first();
      if (!$bank->cookie) {
        $login = DogeController::login($bank->username, $bank->password);
        if ($login->code == 200) {
          $bank->cookie = $login->data->cookie;
          $bank->save();
        }
      }

      if ($bank->cookie) {
        $withdraw = DogeController::withdraw($bank->cookie, $dogeReceiver->wallet, $queue->value);
        if ($withdraw->code == 200) {
          $queue->status = true;
        } else {
          $queue->send_at = Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s');
        }
        $queue->save();
      } else {
        $queue->send_at = Carbon::now()->addMinutes(10)->format('Y-m-d H:i:s');
        $queue->save();
      }
    }
  }
}
