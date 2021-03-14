<?php

namespace App\Console\Commands;

use App\Models\Bill;
use Illuminate\Console\Command;

class RemoveBill extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = "daily:removeBill";

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = "remove bill daily";

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    Bill::where("status", true)->delete();
  }
}
