<?php

namespace App\Console\Commands;

use App\Http\Controllers\DogeController;
use App\Models\Trading;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateCookieBot extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'minute:updateCookieBot';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'renew cookies';

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    $bot = Trading::where("updated_at", "<", Carbon::now()->addMonths(-1))->first();
    if ($bot) {
      try {
        $post = DogeController::login($bot->username, $bot->password);
        if ($post->code < 400) {
          $bot->cookie = $post->data->cookie;
          $bot->save();
        }
      } catch (Exception $e) {
        Log::error($e);
      }
    }
  }
}
