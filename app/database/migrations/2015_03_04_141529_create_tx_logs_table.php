<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTxLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tx_logs', function(Blueprint $table)
        {
            $table->increments('id');
			
			$table->date('tx_date');		//交易日期
			$table->datetime('tx_time')->defaultNow();		//交易时间
			$table->string('pay_acct');		//付款人账号
			$table->string('pay_acct_name');		//付款人户名
			$table->string('recv_acct');		//收款人账号
			$table->string('recv_acct_name');		//收款人户名
			$table->decimal('tx_amt', 17,2);		//交易金额
			$table->char('tx_state',1);		//交易状态
			$table->string('tx_chnl');		//交易途径（方式）
			$table->char('tx_type');		//交易类型  客户付款  点投退款
			$table->string('remark');		//备注
			$table->string('order_id');
			
            
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
		Schema::drop('tx_logs');
	}

}
