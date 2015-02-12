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
            $table->decimal('app_amt', 17,2);       //预约金额
            $table->decimal('app_share', 17,2);       //预约股份占比
            $table->decimal('app_tm', 17,2);       //预约时间
            $table->decimal('app_state', 17,2);       //预约状态
            $table->decimal('ack_amt', 17,2);       //确认金额
            $table->decimal('ack_share', 17,2);       //确认股份占比
            $table->decimal('ack_tm', 17,2);       //确认时间
            $table->decimal('ack_state', 17,2);       //确认状态
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
