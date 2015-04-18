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
            $table->string('project_cover', 255);       //封面（显示在项目列表中的图片）
            $table->string('sub_title', 255);       //一句话亮点
            $table->string('industry_code', 10);      //行业
            $table->string('province_code', 10);        //省份
            $table->string('city_code', 10);        //城市
            $table->string('address', 255)->nullable();     //详细地址
			$table->text('detail')->nullable();					//富文本格式的详细内容	
			$table->string('business_plan')->nullable();

            //公司信息
//			$table->char('has_company',1)->default('N'); //项目是否有公司
//            $table->string('company_name')->nullable();     //公司名称
//            $table->string('legal_person')->nullable();     //法人名称
//            $table->date('startup_date')->nullable();       //成立日期
//            $table->date('registered_address')->nullable();     //注册地址
//            $table->decimal('registered_capital',17,2)->nullable();     //注册资金
//            $table->string('organization_code')->nullable();        //组织机构代码
//            $table->string('legal_id_card')->nullable();        //法人身份证
//            $table->string('legal_cre_rpt')->nullable();        //法人信用报告
//            $table->string('biz_lic')->nullable();      //营业执照
//            $table->string('biz_lic_copy')->nullable();     //营业执照副本
//            $table->string('tax_reg_card')->nullable();     //税务登记证
//            $table->string('tax_reg_card_copy')->nullable();        //税务登记证副本
//            $table->string('org_code_cert')->nullable();        //组织机构代码证
//            $table->string('org_code_cert_copy')->nullable();       //组织机构代码证副本
//            $table->string('finance_rpt')->nullable();      //财务报表
//            $table->string('hyg_lic')->nullable();      //卫生许可证
//            $table->string('company_photo')->nullable();      //公司图片

			//商业分析
            //$table->string('business_plan_uri')->nullable();       //商业计划书
            //$table->text('user_demand')->nullable();        //用户需求
            //$table->text('solution')->nullable();       //解决方案
            //$table->text('solution_advantage');     //解决方案优势
            //$table->text('market_analysis')->nullable();        //市场分析
            //$table->text('development_plan')->nullable();       //发展规划
            //$table->text('revenue_driver')->nullable();     //盈利来源
            //$table->text('cost_structure')->nullable();     //成本构成，直接存JSON，在前台用图表展示
            //$table->text('finance_data')->nullable();     //财务数据，直接存JSON，在前台用图表展示
            //$table->text('profit_forecast')->nullable();        //盈利预测，直接存JSON，在前台用图表展示

            //团队信息
            //$table->text('team_members')->nullable();       //团队信息，直接存JSON，在前台拆开展示

            //$table->char('visibility',1)->default('1');     //项目页显示权限：1.所有人可见 2.注册用户可见  3.认证用户可见
			
            //融资需求
            $table->decimal('raise_quota',17,2);       //融资需求金额
            $table->decimal('min_raise_quota',17,2);       //最小阈值
            $table->decimal('max_raise_quota',17,2);        //最大阈值
            $table->integer('retain_stockholder');      //项目方当前股东人数，所有股东数加起来不能超过200
            $table->decimal('assign_share', 17,2);      //出让股份占比
            $table->decimal('min_sub_quota',17,2);
            $table->integer('raise_days');        //融资天数
            $table->date('raise_start_date')->nullable();      //融资开始时间
            $table->date('raise_end_date')->nullable();        //融资结束时间
			$table->char('allow_nolocal', 1)->nullable()->default('Y');   //是否允许非本地区的用户认购 Y N
			
            
            //当前预约/认购情况，客户每做一笔预约或认购交易都需要更新这两个字段
			$table->decimal('raised_bal', 17,2)->default(0.00);		//项目当前被认购金额
			
			//其他
			$table->char('hot_level', 1)->default('1');  // 项目热销情况 1普通 2热销 3火爆
			$table->char('risk_level', 1)->default('1');  // 风险等级 1 低 2 中 3 高
			$table->string('state', 32)->default('SAVE_DRAFT');   //SAVE_DRAFT草稿暂存 SUBMIT_AUDIT审核中  AUDIT_FAILED审核失败  AUDIT_PASS审核通过  ROADSHOW 路演中 APPOINTMENT预约中 APPOINTMENT_FINISHED预约结束 RAISE募集中 RAISE_FAILED募集失败 RAISE_SUCCESS募集成功 SHARE_OUT_BONUS项目分红 END项目结束

            $table->integer('user_id');     //发起人

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
