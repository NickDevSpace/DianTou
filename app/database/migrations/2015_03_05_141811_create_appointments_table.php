<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAppointmentsTable
 * 预约表
 * 当项目处于预约中时，用户可以申请预约认购
 */
class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id');      //项目id
            $table->decimal('app_part_count', 17,2);       //预约股份占比
            $table->decimal('app_amt', 17,2);       //预约金额
			$table->decimal('app_share', 17,2);
			$table->decimal('app_margin_amt', 17,2);		//已付的预约保证金
            $table->datetime('app_time', 17,2);       //预约时间
            $table->char('state', 1)->default('1');       //预约状态 1-正常 2-请求撤销 3-已撤销
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
		Schema::drop('appointments');
	}

}
