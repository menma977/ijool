<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run(): void
  {
    $this->call(UserSeeder::class);
    $this->call(DogeSeeder::class);
    $this->call(TradingSeeder::class);
    $this->call(ProfileSeeder::class);
    $this->call(SettingSubscribeSeeder::class);
    $this->call(BankSeeder::class);
  }
}
