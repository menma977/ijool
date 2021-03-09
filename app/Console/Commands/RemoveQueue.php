<?php

namespace App\Console\Commands;

use App\Models\Queue;
use Illuminate\Console\Command;

class RemoveQueue extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'daily:removeQueue';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'remove queue daily';

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    Queue::where("status", true)->delete();
  }
}
