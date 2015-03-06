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
			
            $table->integer('sender');
            $table->integer('receiver');
            $table->text('content');
			$table->char('del_by_sender', 1)->default('N');
			$table->char('del_by_receiver', 1)->default('N');
            $table->char('read_by_receiver', 1)->default('N');
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
