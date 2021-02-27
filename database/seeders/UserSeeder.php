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
  public function run(): void
  {
    $user = new User();
    $user->role = 2;
    $user->name = "ijool";
    $user->username = "ijool";
    $user->email = "ijool@ijool.com";
    $user->password = Hash::make("ijoolAdmin");
    $user->code = "ijool@admin";
    $user->email_verified_at = Carbon::now();
    $user->save();
  }
}
