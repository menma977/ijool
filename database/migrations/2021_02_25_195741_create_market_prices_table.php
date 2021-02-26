<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketPricesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('market_prices', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->integer("buy")->default(0);
      $table->integer("sell")->default(0);
      $table->integer("last")->default(0);
      $table->integer("high")->default(0);
      $table->integer("low")->default(0);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('market_prices');
  }
}
