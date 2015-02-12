<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePrivateMessagesTable
 * 用于站内信发送
 */
class CreatePrivateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('private_messages', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('from_user');
            $table->integer('to_user');
            $table->text('content');
            $table->char('is_read', 1)->default('N');
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
        Schema::drop('private_messages');
	}

}
