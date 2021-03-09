<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('bills', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->unsignedBigInteger("from");
      $table->foreign('from')->references('id')->on('users');
      $table->unsignedBigInteger("to");
      $table->foreign('to')->references('id')->on('users');
      $table->string("value");
      $table->boolean("status")->default(false);
      $table->timestamp("send_at")->useCurrent();
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
    Schema::dropIfExists('bills');
  }
}
