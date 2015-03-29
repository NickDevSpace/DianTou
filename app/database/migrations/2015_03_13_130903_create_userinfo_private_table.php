<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfoPrivateTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userinfo_private', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->string('real_name', 160)->nullable();       //真实姓名
			$table->string('mobile', 20);
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();       //生日
            $table->char('sex', 1)->default('S');
            $table->string('crdt_id', 30)->nullable();      //身份证号码
            $table->string('crdt_photo_a', 255)->nullable();      //身份证正面
            $table->string('crdt_photo_b', 255)->nullable();      //身份证反面
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
        Schema::drop('userinfo_private');
	}

}
