<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $user = new User();
    $user->name = "ijool";
    $user->username = "ijool";
    $user->email = "ijool@ijool.com";
    $user->password = Hash::make("ijoolAdmin");
    $user->email_verified_at = Carbon::now();
    $user->save();
  }
}
