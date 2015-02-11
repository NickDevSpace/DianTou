<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateAppointmentsTable
 * 预约表
 * 当项目处于预约阶段时，用户可以预约认购
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
            $table->integer('project_id');
            $table->integer('user_id');
            $table->decimal('app_amt', 17,2);
            $table->decimal('share', 17,2);
            $table->date('app_dt');
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
