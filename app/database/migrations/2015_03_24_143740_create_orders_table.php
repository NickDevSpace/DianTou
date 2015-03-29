<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('sub_id');
            $table->integer('user_id');
            $table->char('state', 1)->default('1');       //认购状态 1-未付款 2-已确认（已交易成功） 3-作废（应长时间未付款或其他原因而作废）
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
        Schema::drop('orders');
	}

}
