<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserinfoEnterpriseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('userinfo_enterprise', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_name')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();
            $table->string('biz_lic_id')->nullable();
            $table->string('biz_lic_addr')->nullable();
            $table->date('biz_exp_dt')->nullable();
            $table->string('biz_lic_photo')->nullable();
            $table->string('biz_lic_photo_sealed')->nullable();
            $table->string('org_code')->nullable();
            $table->string('business_scope')->nullable();
            $table->date('startup_dt')->nullable()->nullable();
            $table->decimal('reg_capital', 17, 2)->nullable()->nullable();
            $table->string('legal_name')->nullable();
            $table->string('legal_crdt_id');
            $table->string('legal_crdt_photo_a')->nullable();
            $table->string('legal_crdt_photo_b')->nullable();
            $table->string('bank_acct')->nullable();
            $table->string('bank_name')->nullable();
            $table->timestamps();
        });
		
		//一、注册时填写邮箱，然后发送验证邮件，用户点击邮箱中的链接继续注册
		//二、填写登录密码
		//实名认证步骤：这一步需企业名称、营业执照注册号、营业执照所在地、营业期限、常用地址、联系电话、营业执照副本扫描、加盖公章副本、组织机构代码、营业范围、注册资金
		//对公账户信息、法人代表信息
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('userinfo_enterprise');
	}

}
