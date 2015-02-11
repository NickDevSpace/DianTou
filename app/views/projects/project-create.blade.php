@extends('layouts.master')
@section('head')
    <style>
        .project-form {
            padding: 100px 0;
        }


        .footer p {
            color: #7f8c8d;
            margin: 0;
            padding: 15px 0;
            text-align: center;
            background: #2d3e50;
        }
    </style>
@stop
@section('content')
<div class="project-form">
    <div class="am-g">
        <div class="am-container">
            <div class="am-progress">
                <div class="am-progress-bar"  style="width: 50%">第一步：填写项目信息</div>
                <div class="am-progress-bar am-progress-bar-success"  style="width: 30%">第二步：完善项目信息</div>
                <div class="am-progress-bar am-progress-bar-warning"  style="width: 20%">第三步：等待审核</div>

            </div>

            <form class="am-form am-form-horizontal">
                <legend>第一步：项目基本信息</legend>
                <div class="am-form-group">
                    <label for="project_name" class="am-u-sm-2 am-form-label">项目名称</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="project_name" placeholder="输入项目名称">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="cover_img" class="am-u-sm-2 am-form-label">项目封面</label>
                    <div class="am-u-sm-10">
                        <input type="file" id="cover_img" placeholder="输入项目封面">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="project_name" class="am-u-sm-2 am-form-label">项目亮点</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="project_name" placeholder="输入项目亮点">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="project_stage" class="am-u-sm-2 am-form-label">所处阶段</label>
                    <div class="am-u-sm-10">
                        <?php echo Form::select('project_stage', $stage_select, '1');?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="team_size" class="am-u-sm-2 am-form-label">团队人数</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="team_size" placeholder="输入团队人数">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="industry_id" class="am-u-sm-2 am-form-label">所属行业</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="industry_id" placeholder="输入团队人数">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="province_code" class="am-u-sm-2 am-form-label">所在省份</label>
                    <div class="am-u-sm-10">
                        <?php echo Form::select('province_code', $province_select);?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="city_code" class="am-u-sm-2 am-form-label">所在城市</label>
                    <div class="am-u-sm-10">
                        <?php echo Form::select('city_code', $city_select);?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="address" class="am-u-sm-2 am-form-label">详细地址</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="address" placeholder="输入详细地址">
                    </div>
                </div>

                <div class="am-form-group">
                    <div class="am-u-sm-10 am-u-sm-offset-2">
                        <button type="button" class="am-btn am-btn-default">下一步</button>
                    </div>
                </div>

                <legend>第二步：商业计划</legend>
                <div class="am-form-group">
                    <label for="business_plan_doc" class="am-u-sm-2 am-form-label">商业计划书</label>
                    <div class="am-u-sm-10">
                        <input type="file" id="business_plan_doc" placeholder="上传商业计划书">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="user_demand" class="am-u-sm-2 am-form-label">用户需求</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="user_demand" placeholder="输入用户需求"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="solution" class="am-u-sm-2 am-form-label">解决方案</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="solution" placeholder="输入解决方案"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="solution_advantage" class="am-u-sm-2 am-form-label">解决方案优势*</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="solution_advantage" placeholder="输入解决方案优势"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="market_analysis" class="am-u-sm-2 am-form-label">市场分析*</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="market_analysis" placeholder="输入市场分析"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="development_plan" class="am-u-sm-2 am-form-label">发展规划*</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="development_plan" placeholder="输入发展规划"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="other" class="am-u-sm-2 am-form-label">其他说明*</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="other" placeholder="输入其他说明"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="project_album" class="am-u-sm-2 am-form-label">项目相册</label>
                    <div class="am-u-sm-10">
                        <input type="file" id="project_album" placeholder="上传项目相册">
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-10 am-u-sm-offset-2">
                        <button type="button" class="am-btn am-btn-default">下一步</button>
                    </div>
                </div>
                <legend>第三步：盈利模式</legend>
                <div class="am-form-group">
                    <label for="revenue_driver" class="am-u-sm-2 am-form-label">收入来源*</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="revenue_driver" placeholder="输入收入来源"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="cost_structure" class="am-u-sm-2 am-form-label">成本结构JSON*</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="cost_structure" placeholder="输入成本结构JSON">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="financial_data" class="am-u-sm-2 am-form-label">财务数据JSON*</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="financial_data" placeholder="输入财务数据JSO">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="profit_forecast" class="am-u-sm-2 am-form-label">盈利预测JSON*</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="profit_forecast" placeholder="输入盈利预测JSON">
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-10 am-u-sm-offset-2">
                        <button type="button" class="am-btn am-btn-default">下一步</button>
                    </div>
                </div>
                <legend>第四步：团队信息</legend>
                <div class="am-form-group">
                    <label for="team_members" class="am-u-sm-2 am-form-label">团队成员JSON*</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="team_members" placeholder="输入团队成员JSON">
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-10 am-u-sm-offset-2">
                        <button type="button" class="am-btn am-btn-default">下一步</button>
                    </div>
                </div>
                <legend>第五步：公司信息</legend>
                <div class="am-form-group">
                    <label for="has_company" class="am-u-sm-2 am-form-label">所在城市</label>
                    <div class="am-u-sm-10">
                        <?php echo Form::select('has_company', array('Y'=>'是', 'N'=>'否'));?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="company_info" class="am-u-sm-2 am-form-label">公司信息JSON*</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="company_info" placeholder="公司信息JSON">
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-10 am-u-sm-offset-2">
                        <button type="submit" class="am-btn am-btn-default">提交审核</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
@stop

