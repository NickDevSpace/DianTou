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
            $table->decimal('app_amt', 17,2)->nullable();       //预约金额
            $table->decimal('app_share', 17,2)->nullable();       //预约股份占比
            $table->datetime('app_tm', 17,2)->nullable();       //预约时间
            $table->char('app_state', 1)->default('0');       //预约状态 0-未预约 1-已预约 2-已撤销
            $table->decimal('ack_amt', 17,2)->nullable();       //确认金额
            $table->decimal('ack_share', 17,2)->nullable();       //确认股份占比
            $table->datetime('ack_tm', 17,2)->nullable();       //确认时间
            $table->char('ack_state', 1)->default('0');       //认购状态 0-未认购 1-已认购 2-已撤销
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
