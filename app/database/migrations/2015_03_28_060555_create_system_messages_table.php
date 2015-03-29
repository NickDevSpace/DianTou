<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('system_messages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('title');
            $table->text('content');
            $table->char('send_type',1);    //0为全体发送，1为只发送给个人会员，2为只发送给企业会员，3为指定会员发送
            $table->datetime('send_time');
            $table->integer('sender');      //系统自动发的填0，管理员发的填管理员id
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
        Schema::drop('system_messages');
	}

}
