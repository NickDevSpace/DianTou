<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateProjectsTable
 * 项目信息
 * 表中信息有点多，是否考虑拆分
 */
class CreateProjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('projects', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('project_no', 20);  //程序生成的项目编号

            //项目基本信息
            $table->string('project_name', 100);        //项目名称
            $table->string('cover_img', 255);       //封面（显示在项目列表中的图片）
            $table->string('big_point', 255);       //一句话亮点
            $table->string('industry_code', 10);      //行业
            $table->string('province_code', 10);        //省份
            $table->string('city_code', 10);        //城市
            $table->string('address', 255)->nullable();     //详细地址

            //公司信息
            $table->string('company_name');     //公司名称
            $table->string('legal_person');     //法人名称
            $table->date('startup_date');       //成立日期
            $table->date('registered_address');     //注册地址
            $table->decimal('registered_capital',17,2);     //注册资金
            $table->string('organization_code');        //组织机构代码
            $table->string('legal_id_card_uri');        //法人身份证
            $table->string('legal_cre_rpt_uri');        //法人信用报告
            $table->string('biz_lic_uri');      //营业执照
            $table->string('biz_lic_copy_uri');     //营业执照副本
            $table->string('tax_reg_card_uri');     //税务登记证
            $table->string('tax_reg_card_copy_uri');        //税务登记证副本
            $table->string('org_code_cert_uri');        //组织机构代码证
            $table->string('org_code_cert_copy_uri');       //组织机构代码证副本
            $table->string('finance_rpt_uri')->nullable();      //财务报表
            $table->string('hyg_lic_uri')->nullable();      //卫生许可证
            $table->string('company_img_uri')->nullable();      //公司图片

            //融资需求
            $table->decimal('total_amt',17,2);     //总金额
            $table->decimal('retain_amt',17,2);      //项目方保留金额
            $table->decimal('fin_amt',17,2);       //融资金额
            $table->integer('share_count');           //认购份数
            $table->decimal('amt_per_share',17,2);     //最小认购金额
            $table->integer('fin_days');        //融资天数
            $table->date('fin_start_date');      //融资开始时间
            $table->date('fin_end_date');        //融资结束时间

            //商业分析
            $table->string('business_plan_uri')->nullable();       //商业计划书
            $table->text('user_demand')->nullable();        //用户需求
            $table->text('solution')->nullable();       //解决方案
            $table->text('solution_advantage');     //解决方案优势
            $table->text('market_analysis')->nullable();        //市场分析
            $table->text('development_plan')->nullable();       //发展规划
            $table->text('revenue_driver')->nullable();     //盈利来源
            $table->text('cost_structure')->nullable();     //成本构成，直接存JSON，在前台用图表展示
            $table->text('finance_data')->nullable();     //财务数据，直接存JSON，在前台用图表展示
            $table->text('profit_forecast')->nullable();        //盈利预测，直接存JSON，在前台用图表展示

            //团队信息
            $table->text('team_members')->nullable();       //团队信息，直接存JSON，在前台拆开展示

            $table->char('visibility',1)->default('1');     //项目页显示权限：1.所有人可见 2.注册用户可见  3.认证用户可见
            $table->char('state', 1)->default('1');   //草稿暂存 审核中  审核失败  审核通过  预热中  融资中  融资失败  融资成功 项目分红

            $table->integer('user_id');     //发起人

            $table->integer('check_user_id');       //审核人
			$table->timestamps();

            $table->unique('project_no');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('projects');
	}

}
