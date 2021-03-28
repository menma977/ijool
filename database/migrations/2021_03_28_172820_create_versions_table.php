<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('versions', function (Blueprint $table) {
      $table->uuid("id")->primary();
      $table->integer("desktop_code");
      $table->string("desktop_name");
      $table->integer("apk_code");
      $table->string("apk_name");
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
    Schema::dropIfExists('versions');
  }
}
