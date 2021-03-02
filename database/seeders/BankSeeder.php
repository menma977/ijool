<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $bank = new Bank();
    $bank->username = "ijool.bank";
    $bank->password = "462066+A";
    $bank->wallet = "DDhsh5561iHsdZTueQoBudTJiCPtFM6tZA";
    $bank->save();
  }
}
