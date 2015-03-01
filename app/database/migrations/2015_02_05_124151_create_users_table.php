<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable
 * 注册用户信息
 */
class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('mobile', 20);    //注册时必填，登录可用的手机
            $table->string('nickname', 100)->nullable();  //用户可以修改的自己的昵称，只能修改一次
            $table->string('password', 60);  //登录密码
            $table->string('email', 100)->nullable();     //登录可用的邮箱
            $table->char('sex', 1)->default('S');   // F-女 M-男  S-保密
            $table->string('province_code', 10);        //省份
            $table->string('city_code',10);     //城市
            $table->string('address', 255)->nullable();     //联系地址
            $table->string('avatar', 255)->nullable();      //用户头像
            $table->char('is_verified',1)->default('N');   //是否通过验证
            $table->string('real_name', 160)->nullable();       //真实姓名
            $table->string('crdt_id', 30)->nullable();      //身份证号码
            $table->string('crdt_photo_A', 255)->nullable();      //身份证正面
            $table->string('crdt_photo_B', 255)->nullable();      //身份证反面
            $table->date('birthday')->nullable();       //生日
            $table->integer('user_level')->default(1);      //用户等级：普通用户，审核用户，管理员
            $table->char('active')->default('Y');       //是否激活
            $table->timestamp('last_login')->nullable();    //最后登录时间
            $table->string('last_login_ip', 15)->nullable();        //最后登录IP
            $table->string('last_login_dev', 15)->nullable();        //最后登录设备
            $table->string('remember_token', 100)->nullable();      //Laravel记住我
			$table->timestamps();

            $table->unique('mobile');
            $table->unique('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
