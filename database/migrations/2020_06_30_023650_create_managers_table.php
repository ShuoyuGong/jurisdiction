<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('managers', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('username', 10)->comment('用户名');
      $table->string('password', 150)->default('123456')->comment('密码');
      $table->string('phone_num', 20)->comment('电话');
      $table->string('email', 150)->comment('邮箱');
      $table->string('super_admin', 2)->default(0)->comment('是否为超级管理员，默认否');
      $table->integer('status')->default(1)->comment('状态');
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
    Schema::dropIfExists('managers');
  }
}
