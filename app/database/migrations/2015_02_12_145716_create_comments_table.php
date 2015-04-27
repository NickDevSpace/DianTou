<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateCommentsTable
 * 每个项目页面底下的评论
 */
class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('project_comments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('user_id');
            $table->integer('replay_to')->nullable();
            $table->text('content');
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
        Schema::drop('project_comments');
	}

}
