<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTradingsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('tradings', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->unsignedBigInteger("user_id");
      $table->foreign('user_id')->references('id')->on('users');
      $table->string("username");
      $table->string("password");
      $table->text("wallet");
      $table->text("cookie")->nullable();
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
    Schema::dropIfExists('tradings');
  }
}
