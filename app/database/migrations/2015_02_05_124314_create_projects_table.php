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
			$table->char('has_company',1)->default('N'); //项目是否有公司
            $table->string('company_name')->nullable();     //公司名称
            $table->string('legal_person')->nullable();     //法人名称
            $table->date('startup_date')->nullable();       //成立日期
            $table->date('registered_address')->nullable();     //注册地址
            $table->decimal('registered_capital',17,2)->nullable();     //注册资金
            $table->string('organization_code')->nullable();        //组织机构代码
            $table->string('legal_id_card')->nullable();        //法人身份证
            $table->string('legal_cre_rpt')->nullable();        //法人信用报告
            $table->string('biz_lic')->nullable();      //营业执照
            $table->string('biz_lic_copy')->nullable();     //营业执照副本
            $table->string('tax_reg_card')->nullable();     //税务登记证
            $table->string('tax_reg_card_copy')->nullable();        //税务登记证副本
            $table->string('org_code_cert')->nullable();        //组织机构代码证
            $table->string('org_code_cert_copy')->nullable();       //组织机构代码证副本
            $table->string('finance_rpt')->nullable();      //财务报表
            $table->string('hyg_lic')->nullable();      //卫生许可证
            $table->string('company_photo')->nullable();      //公司图片

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
            $table->decimal('total_quota',17,2);     //总金额
            $table->decimal('retain_quota',17,2);      //项目方保留金额
            $table->decimal('raise_quota',17,2);       //融资金额
			$table->integer('part_count');		//分割份数
            $table->decimal('quota_of_part',17,2);     //每份金额
            $table->integer('raise_days');        //融资天数
            $table->date('raise_start_date')->nullable();      //融资开始时间
            $table->date('raise_end_date')->nullable();        //融资结束时间
			$table->char('app_flag', 1)->default('Y');		//是否支持预约，如果选择否，那么项目审批后直接进入融资阶段；
															//如果选择是，那么项目通过审批后进入预约状态，预约状态会持续一段时间，用户可以进行预约（按预约比率缴纳保证金），我们为预约的用户在项目融资阶段保留他们预约的金额，并在一段时间内供他们认购，如果超出时间限制则吞没保证金
			$table->decimal('app_open_part_count', 17,2)->nullable();;		//raise_quota中的开放预约份额数
			$table->char('app_margin_flag', 1)->nullable()->default('N');		//预约是否需要保证金 Y N
			$table->decimal('app_margin_ratio', 17,2)->nullable();;		//预约的保证金比率
			$table->date('app_start_date')->nullable();		//预约开始时间
			$table->date('app_end_date')->nullable();		//预约结束时间，到期后可进入融资阶段，如果预约情况不佳，可直接废弃该项目
			$table->char('allow_nolocal', 1)->nullable()->default('Y');   //是否允许非本地区的用户认购 Y N
			
            
            //当前预约/认购情况，客户每做一笔预约或认购交易都需要更新这两个字段
			$table->decimal('apped_bal', 17,2)->default(0.00);		//项目当前被预约金额
			$table->integer('apped_part_cnt')->default(0);		//被预约的分数
			$table->decimal('raised_bal', 17,2)->default(0.00);		//项目当前被认购金额
			$table->integer('raised_part_cnt')->default(0);		//被预约的分数
			
			//其他
			$table->char('hot_level', 1)->default('1');  // 项目热销情况 1普通 2热销 3火爆
			$table->char('risk_level', 1)->default('1');  // 风险等级 1 低 2 中 3 高
			$table->char('state', 2)->default('01');   //01草稿暂存 02审核中  03审核失败  04审核通过  05预约中 06预约结束 07募集中 08募集失败 09募集成功 10项目分红 11项目结束

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
