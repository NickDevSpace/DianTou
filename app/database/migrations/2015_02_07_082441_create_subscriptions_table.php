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
            $table->string('sub_order');
            $table->integer('project_id');      //项目id
            $table->integer('user_id');     //用户id
            $table->integer('sub_copies');      //认购的份数
            $table->decimal('quota_of_copy', 17,2);       //每份金额
            $table->decimal('sub_amt', 17,2);       //总认购金额
            $table->decimal('sub_share', 17,2);       //认购股份占比
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
        Schema::drop('subscriptions');
	}

}
