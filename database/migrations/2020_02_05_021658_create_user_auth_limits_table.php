<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAuthLimitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_auth_limits', function (Blueprint $table) {
            $table->timestamps();
            $table->unsignedInteger('uid');
            $table->unsignedInteger('app_id');
            $table->unsignedInteger('free_remain_request_times_pre_day')->default(0); // 每天的免費次數
            $table->unsignedInteger('remain_request_times')->default(0); // 付費的請求次數
            $table->primary(array('uid','app_id'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_auth_limits');
    }
}
