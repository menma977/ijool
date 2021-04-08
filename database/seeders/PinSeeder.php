<?php

namespace Database\Seeders;

use App\Models\Pin;
use Illuminate\Database\Seeder;

class PinSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $pin = new Pin();
    $pin->user_id = 1;
    $pin->debit = 1000000000;
    $pin->save();

    $pin = new Pin();
    $pin->user_id = 1;
    $pin->debit = 1000000000;
    $pin->save();

    $pin = new Pin();
    $pin->user_id = 1;
    $pin->debit = 1000000000;
    $pin->save();

    $pin = new Pin();
    $pin->user_id = 1;
    $pin->debit = 1000000000;
    $pin->save();

    $pin = new Pin();
    $pin->user_id = 1;
    $pin->debit = 1000000000;
    $pin->save();
  }
}
