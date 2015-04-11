<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoadshowScenesTable
 * 路演场次表
 */
class CreateRoadshowScenesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('roadshow_scenes', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('province_code');        //路演省份
            $table->string('city_code');            //路演城市
            $table->string('title');                //场次标题
            $table->date('scene_date');             //场次时间
            $table->text('address');                //举办地址
            $table->text('detail');                 //详情
            $table->integer('seats');          //名额
            $table->char('state',1)->default('1');            //1-未开始 2-进行中 3-已结束
            $table->text('note')->nullable();                   //其他记录
            $table->integer('create_user');
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
        Schema::drop('roadshow_scenes');
	}

}
