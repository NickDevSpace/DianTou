<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSubscriptionsTable
 * 正式认购表
 * 当项目处于融资中时，用户可以申请正式认购
 */
class CreateSubscriptionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('subscriptions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id');      //项目id
            $table->decimal('sub_part_count', 17,2);       //预约股份占比
            $table->decimal('sub_amt', 17,2);       //认购金额
            $table->decimal('sub_share', 17,2);       //认购股份占比
            $table->datetime('sub_time', 17,2);       //认购时间
            $table->char('state', 1)->default('1');       //认购状态 1-正常 2-请求撤销 3-已撤销
            $table->integer('user_id');     //用户id
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
        Schema::drop('subscriptions');
	}

}
