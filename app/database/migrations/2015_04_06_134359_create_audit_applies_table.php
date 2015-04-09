<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuditAppliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('audit_applies', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('obj_id');      //申请审核对象id：如果是用户实名认证，则保存用户id，如果是项目，保存项目id
            $table->string('obj_type');     //申请项目类型：USER_CERTIFY   PROJECT_AUDIT
            $table->text('obj_snapshot')->nullable();     //尽量把当时审核的所有字段存下来，可以存json，用来备用
            $table->dateTime('submit_time');        //提交时间
            $table->integer('submit_user');     //审核申请提交人
            $table->text('audit_comment')->nullable();      //审核意见
            $table->char('audit_state', 1)->default('0');       //审核结果：0 表示待审核 1 表示通过 2表示不通过
            $table->integer('audit_user')->nullable();         //审核用户
            $table->dateTime('audit_time')->nullable();     //审核时间
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
        Schema::drop('audit_applies');
	}

}
