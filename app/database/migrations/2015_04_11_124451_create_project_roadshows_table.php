<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectRoadshowsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('project_roadshows', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('roadshow_scene_id');
            $table->integer('show_seq');
            $table->char('attended',1)->default('N');       //是否出席
            $table->string('show_video')->nullable();
            $table->text('show_detail')->nullable();
            $table->decimal('point', 5,2)->default(0.00);     //打分 10分满分 例如9.85
            $table->string('next_state');      //项目下一步状态 三选一 APPOINTMENT/RAISE/END
            $table->char('accept_state',1)->default('1');     //1-未完成  2-暂存  3-完成
            $table->integer('accept_user');       //验收用户
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
        Schema::drop('project_roadshows');
	}

}
