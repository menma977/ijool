<?php

namespace Database\Seeders;

use App\Models\Doge;
use App\Models\User;
use Illuminate\Database\Seeder;

class DogeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(): void
  {
    $doge = new Doge();
    $doge->user_id = User::first()->id;
    $doge->username = "ijool";
    $doge->password = "462066+A";
    $doge->wallet = "DLm6aDzGFquWUEFvvFJvXsr3K1QvZX7phG";
    $doge->save();
  }
}
