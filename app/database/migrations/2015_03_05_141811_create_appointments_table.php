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
