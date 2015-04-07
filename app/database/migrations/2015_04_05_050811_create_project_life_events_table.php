<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProjectLifeEventsTable
 * 该表用于记录项目一些里程碑式的事件，可用于在项目详情中展示
 * 主要里程碑：审核通过，路演开始，预约开始，融资开始，融资成功，分红
 */
class CreateProjectLifeEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('project_life_events', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id');
            $table->string('event_type');
            $table->string('event_desc');
            $table->string('event_date');
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
        Schema::drop('project_life_events');
	}

}
