@extends('layouts.master')
@section('page_title')
发起项目 | 点投
@stop
@section('head')
    <link rel="stylesheet" href="{{{asset('assets/vendor/kindeditor/themes/default/default.css')}}}"/>
    <link rel="stylesheet" href="{{{asset('assets/vendor/jcrop/css/jquery.Jcrop.css')}}}"/>
    <style>
        .project-form {
            padding: 75px 0;
        }



    </style>

@stop
@section('content')
<div class="project-form">
    <div class="am-g">
        <div class="am-container">
            <div class="am-progress">
				<div class="am-progress-bar"  style="width: 20%">第一步：身份认证</div>
                <div class="am-progress-bar am-progress-bar-success"  style="width: 50%">第一步：填写项目信息</div>
                <div class="am-progress-bar am-progress-bar-warning"  style="width: 30%">第三步：等待审核</div>
                

            </div>

            <form id="project-create-form" action="/project/save" method="post" class="am-form am-form-horizontal">
                <legend>基本信息</legend>
                <div class="am-form-group">
                    <label for="i-project-name" class="am-u-sm-3 am-form-label">项目名称</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-project-name" name="project_name" placeholder="输入项目名称" data-validate-message="项目名称不能为空" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-project-cover" class="am-u-sm-3 am-form-label">项目封面</label>
                    <div class="am-u-sm-3">
                         <div id="cover-picker">选择图片</div>
                         <input type="hidden" id="i-project-cover" name="project_cover"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                         <div id="project-cover-preview"></div>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-sub-title" class="am-u-sm-3 am-form-label">项目标语</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" name="sub_title" placeholder="输入项目标语" data-validate-message="项目标语不能为空" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-industry-2" class="am-u-sm-3 am-form-label">所属行业</label>
                    <div class="am-u-sm-3">
                        <?php echo Form::amSelect(array('list'=>$industry_select, 'value_field'=>'industry_code','text_field'=>'industry_name', 'header_text' => '请选择', 'id' => 'i-industry-1', 'required' => 'true')); ?>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_text' => '请选择', 'id' => 'i-industry-2', 'name'=>'industry_code', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-city-code" class="am-u-sm-3 am-form-label">所在城市</label>
                    <div class="am-u-sm-3">
                        <?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'required' => 'true')); ?>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="address" class="am-u-sm-3 am-form-label">详细地址</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="address" name="address" placeholder="输入详细地址" data-validate-message="项目地址不能为空" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-detail" class="am-u-sm-3 am-form-label">项目介绍</label>
                    <div class="am-u-sm-6 am-u-end">
                        <textarea id="i-detail" name="detail" style="width:100%;height:400px;visibility:hidden;">
                        <h2>关于我（也可使用个性化小标题）</h2>
                        向支持者介绍你自己或你的团队，并详细说明你与所发起的项目之间的背景，让支持者能够在最短时间内了解你，以拉近彼此之间的距离。
                        <h2>我想要做什么（也可使用个性化小标题）</h2>
                        这是项目介绍中最关键的部分，建议上传5张以上高清图片（宽700、高不限），配合文字来简洁生动地说明你的项目，让支持者对你要做的事情一目了然并充满兴趣。
                        <h2>为什么我需要你的支持及资金用途（也可使用个性化小标题）</h2>
                        请在这一部分说明你的项目不同寻常的特色，为什么需要大家的支持以及详细的资金用途，这会增加你项目的可信度并由此提高筹资的成功率。
                        <h2>可能存在的风险（也可使用个性化小标题）</h2>
                        请在此标注你的项目在实施过程中可能存在的风险，让支持者对你的项目有全面而清晰的认识。
                        </textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="business_plan" class="am-u-sm-3 am-form-label">项目计划书</label>
                    <div class="am-u-sm-6 am-u-end">
                        <div id="plan-picker" >选择文件</div>
                        <input type="hidden" name="business_plan"/>
                    </div>
                </div>

                <legend>融资需求</legend>
                <div class="am-form-group">
                    <label for="i-total-quota" class="am-u-sm-3 am-form-label">融资需求金额</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="number" id="i-total-quota" name="raise_quota" placeholder="填写该项目融资所需的总金额（元）" data-validate-message="融资总额必须为大于等于10000" min="10000" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-retain-stockholder" class="am-u-sm-3 am-form-label">当前股东人数</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="number" id="i-retain-stockholder" name="retain_stockholder" placeholder="填写该项目目前的股东人数" data-validate-message="请填写介于1-199的整数" min="1" max="199"required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-assign-share" class="am-u-sm-3 am-form-label">出让股份占比</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="number" id="i-assign-share" name="assign_share" placeholder="出让股份占比" data-validate-message="项目方出资金额不能大于融资总额" min="0" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-assign-copies" class="am-u-sm-3 am-form-label">可认购份数</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="number" id="i-assign-copies" name="assign_copies" placeholder="认购份数" data-validate-message="认购份数必须为大于0小于200的整数" min="1" max="200" required>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-app-open-part-count" class="am-u-sm-3 am-form-label">其中可预约份数</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="number" id="i-app-open-part-count" name="app_open_part_count" data-validate-message="可预约分数为不大于可认购分数的整数值" min="0" placeholder="可预约份数建议控制在认购份数的60%以下" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="" class="am-u-sm-3 am-form-label">每份金额</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="number" name="quota_of_copy" readonly="true" placeholder="每份金额" >
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="" class="am-u-sm-3 am-form-label">融资期限</label>
                    <div class="am-u-sm-6 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(array('value'=>'30', 'text'=>'30天'), array('value'=>'60', 'text'=>'60天'), array('value'=>'120', 'text'=>'120天')), 'value_field'=>'value','text_field'=>'text', 'id' => 'i-raise-days', 'name' => 'raise_days', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="" class="am-u-sm-3 am-form-label">是否允许其他地区用户认购</label>
                    <div class="am-u-sm-6 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(array('value'=>'Y', 'text'=>'是'), array('value'=>'N', 'text'=>'否')), 'value_field'=>'value','text_field'=>'text', 'id' => 'i-allow-nolocal', 'name' => 'allow_nolocal', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-offset-3 am-u-sm-6">
                      <div class="checkbox">
                          <input type="checkbox" checked="checked"> 我同意<a href="#">点投网服务协议</a>
                      </div>
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-10 am-u-sm-offset-2">
                        <button type="submit" class="am-btn am-btn-primary">提交审核</button>
                        <button type="submit" class="am-btn am-btn-default">保存</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div id="cover-editor" class="am-modal am-modal-confirm" tabindex="-1" >
  <div class="am-modal-dialog">
    <div class="am-modal-hd">图片裁剪</div>
    <div class="am-modal-bd">
        <div id="crop-container"></div>
        <span id="crop-tip"></span>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>

</div>

@stop

@section('vendor_js')
<script src="{{{asset('assets/js/json2.js')}}}"></script>
<script src="{{{asset('assets/vendor/kindeditor/kindeditor-min.js')}}}"></script>
<script src="{{{asset('assets/vendor/kindeditor/lang/zh_CN.js')}}}"></script>
<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
<script src="{{{asset('assets/vendor/jcrop/js/jquery.Jcrop.min.js')}}}"></script>
@stop
@section('page_js')
<script>
    
	$(function(){
		App.init(['project.create']);
	});





</script>
@stop

