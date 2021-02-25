<?php

namespace App\Console\Commands;

use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ValidationSubscribe extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'minute:subscribe';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'make subscribe finish when ready';

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    $subscribe = Subscribe::whereDay("expired_at", "<=", Carbon::now())->where("is_finished", false)->first();
    if ($subscribe) {
      $subscribe->is_finished = true;
      $subscribe->save();
    }
  }
}
