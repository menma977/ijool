<?php

namespace Database\Seeders;

use App\Models\Version;
use Illuminate\Database\Seeder;

class VersionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $version = new Version();
    $version->desktop_code = 1;
    $version->desktop_name = "0.1.0";
    $version->apk_code = 1;
    $version->apk_name = "0.1.0";
    $version->save();
  }
}
