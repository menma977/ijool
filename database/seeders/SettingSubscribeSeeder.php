<?php

namespace Database\Seeders;

use App\Models\SettingSubscribe;
use Illuminate\Database\Seeder;

class SettingSubscribeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $setting = new SettingSubscribe();
    $setting->price = 5000000000;
    $setting->discount_price = 0;
    $setting->save();
  }
}
