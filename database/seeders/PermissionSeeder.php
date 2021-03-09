<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $permission = new Permission();
    $permission->user_id = 1;
    $permission->role_id = 1;
    $permission->save();

    $permission = new Permission();
    $permission->user_id = 1;
    $permission->role_id = 2;
    $permission->save();
  }
}
