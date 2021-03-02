<?php

namespace Database\Seeders;

use App\Models\Trading;
use App\Models\User;
use Illuminate\Database\Seeder;

class TradingSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $trading = new Trading();
    $trading->user_id = User::first()->id;
    $trading->username = "ijool";
    $trading->password = "462066+A";
    $trading->wallet = "DLm6aDzGFquWUEFvvFJvXsr3K1QvZX7phG";
    $trading->save();
  }
}
