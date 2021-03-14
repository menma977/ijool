<?php

namespace App\Console\Commands;

use App\Models\Bill;
use App\Models\Doge;
use App\Models\Line;
use App\Models\Permission;
use App\Models\Profile;
use App\Models\Queue;
use App\Models\Subscribe;
use App\Models\Trading;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveUser extends Command
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = "daily:removeUser";

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = "delete user when not active";

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    $user = User::whereNull("email_verified_at")->where("created_at", "<=", Carbon::now()->addDays(-1))->first();
    if ($user) {
      Doge::where("user_id", $user->id)->delete();
      Trading::where("user_id", $user->id)->delete();
      Profile::where("user_id", $user->id)->delete();
      Subscribe::where("user_id", $user->id)->delete();
      Queue::where("from", $user->id)->orWhere("to", $user->id)->delete();
      Bill::where("from", $user->id)->orWhere("to", $user->id)->delete();
      Line::where("user_id", $user->id)->orWhere("mate", $user->id)->delete();
      Permission::where("user_id", $user->id)->delete();
      $user->delete();
    }
  }
}
