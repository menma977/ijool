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
  protected $signature = 'daily:removeUser';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'delete user when not active';

  /**
   * Execute the console command.
   *
   */
  public function handle()
  {
    $user = User::whereNull("email_verified_at")->where("created_at", ">=", Carbon::now()->subDay())->first();
    if ($user) {
      Doge::deleted($user->id);
      Trading::deleted($user->id);
      Profile::deleted($user->id);
      Subscribe::where("user_id", $user->id)->deleted();
      Queue::where("from", $user->id)->orWhere("to", $user->id)->deleted();
      Bill::where("from", $user->id)->orWhere("to", $user->id)->deleted();
      Line::where("user_id", $user->id)->orWhere("mate", $user->id)->deleted();
      Permission::where("user_id", $user->id)->deleted();
      $user->deleted();
    }
  }
}
