<?php

namespace App\Console\Commands;

use App\Http\Controllers\DogeController;
use App\Models\Doge;
use Carbon\Carbon;
use http\Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateCookieDoge extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'minute:updateCookieDoge';

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
    $doge = Doge::where("updated_at", "<", Carbon::now()->addMonths(-1))->first();
    if ($doge) {
      try {
        $post = DogeController::login($doge->username, $doge->password);
        if ($post->code < 400) {
          $doge->cookie = $post->data->cookie;
          $doge->save();
        }
      } catch (Exception $e) {
        Log::error($e);
      }
    }
  }
}
