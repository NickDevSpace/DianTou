@extends('layouts.master')
@section('page_title')
发起项目 | 点投
@stop
@section('head')
    <link rel="stylesheet" href="{{{asset('assets/vendor/kindeditor/themes/default/default.css')}}}"/>
    <link rel="stylesheet" href="{{{asset('assets/vendor/jcrop/css/jquery.Jcrop.css')}}}"/>
    <style>
        .project-form {
            padding: 100px 0;
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

            <form action="/project/create" class="am-form am-form-horizontal">
                <legend>基本信息</legend>
                <div class="am-form-group">
                    <label for="project_name" class="am-u-sm-2 am-form-label">项目名称</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="project_name" name="project_name" placeholder="输入项目名称">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="project_cover" class="am-u-sm-2 am-form-label">项目封面</label>
                    <div class="am-u-sm-2">
                         <div id="cover-picker">选择图片</div>
                         <input type="hidden" name="project_cover"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="project-cover-preview"></div>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="" class="am-u-sm-2 am-form-label">项目标语</label>
                    <div class="am-u-sm-10">
                        <input type="text" name="project_title" placeholder="输入项目标语">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="industry_id" class="am-u-sm-2 am-form-label">所属行业</label>
                    <div class="am-u-sm-2">
                        <?php echo Form::amSelect(array('list'=>$industry_select, 'value_field'=>'industry_code','text_field'=>'industry_name', 'header_value' => '', 'header_text' => '请选择', 'id' => 'industry_1')); ?>
                    </div>
                    <div class="am-u-sm-2 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'',  'header_value' => '', 'header_text' => '请选择', 'id' => 'industry_2', 'name'=>'industry_code')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="province_code" class="am-u-sm-2 am-form-label">所在城市</label>
                    <div class="am-u-sm-2">
                        <?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_value' => '', 'header_text' => '请选择', 'id' => 'province_code', 'name' => 'province_code')); ?>
                    </div>
                    <div class="am-u-sm-2 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_value' => '', 'header_text' => '请选择', 'id' => 'city_code', 'name' => 'city_code')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="address" class="am-u-sm-2 am-form-label">详细地址</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="address" name="address" placeholder="输入详细地址">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="address" class="am-u-sm-2 am-form-label">项目介绍</label>
                    <div class="am-u-sm-10">
                        <textarea name="content" style="width:100%;height:400px;visibility:hidden;">
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

                <legend>商业计划</legend>
                <div class="am-form-group">
                    <label for="user_demand" class="am-u-sm-2 am-form-label">用户需求</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="user_demand" name="user_demand" placeholder="输入用户需求"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="solution" class="am-u-sm-2 am-form-label">解决方案</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="solution" name="solution" placeholder="输入解决方案"></textarea>
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
                        <textarea class="" rows="5" id="market_analysis" name="market_analysis" placeholder="输入市场分析"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="development_plan" class="am-u-sm-2 am-form-label">发展规划*</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="development_plan" name="development_plan" placeholder="输入发展规划"></textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="other" class="am-u-sm-2 am-form-label">其他说明*</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="other" name="other" placeholder="输入其他说明"></textarea>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="business_plan_doc" class="am-u-sm-2 am-form-label">商业计划书</label>
                    <div class="am-u-sm-10">
                        <div class="resource-picker">选择文件</div>
                        <input type="hidden" name="business_plan_doc"/>
                    </div>
                </div>

                <legend>盈利模式</legend>
                <div class="am-form-group">
                    <label for="revenue_driver" class="am-u-sm-2 am-form-label">收入来源*</label>
                    <div class="am-u-sm-10">
                        <textarea class="" rows="5" id="revenue_driver" name="revenue_driver" placeholder="输入收入来源"></textarea>
                    </div>
                </div>
                <script id="hehe">
                <div>xxxxx</div>
                </script>
                <div class="am-form-group">
                    <label for="cost_structure" class="am-u-sm-2 am-form-label">成本结构</label>
                    <div class="am-u-sm-10">
                        <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">
                                <table id="cs-table" class="am-table json-table">
                                    <input type="hidden" class="json-field" name="cost_structure"/> <!-- 存放JSON -->
                                    <tbody>
                                        <tr>
                                            <td style="border:0"><input type="text" data-name="cost_name" placeholder="主要成本或费用名称"></td>
                                            <td style="border:0"><input type="text" data-name="cost_amt" placeholder="金额（万元）"></td>
                                            <td style="border:0"><a href="javascript:;" class="json-table-del-row am-vertical-align-middle">删除</a></td>
                                        </tr>
                                        <tr>
                                            <td style="border:0"><input type="text" data-name="cost_name" placeholder="主要成本或费用名称"></td>
                                            <td style="border:0"><input type="text" data-name="cost_amt" placeholder="金额（万元）"></td>
                                            <td style="border:0"><a href="javascript:;" class="json-table-del-row am-vertical-align-middle">删除</a></td>
                                        </tr>
                                    </tbody>

                                </table>

                                <div class="am-cf">
                                    <a href="javascript:;" class="json-table-add-row am-icon-btn  am-icon-plus am-center" for="cs-table"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-form-group  json-table">
                    <label for="financial_data" class="am-u-sm-2 am-form-label">财务数据</label>
                    <div class="am-u-sm-10">
                        <input type="hidden" class="json-field" name="financial_data"/> <!-- 存放JSON -->
                        <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">
                                <table id="cs-table" class="am-table">
                                    <tbody>
                                        <tr>
                                            <td style="border:0">2013年<input type="hidden" data-name="year" value="2013"></td>
                                            <td style="border:0"><input type="text" data-name="income" placeholder="营业额（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="gross_profit" placeholder="毛利润（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="net_profit" placeholder="净利润（万元）"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:0">2014年<input type="hidden" data-name="year" value="2014"></td>
                                            <td style="border:0"><input type="text" data-name="income" placeholder="营业额（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="gross_profit" placeholder="毛利润（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="net_profit" placeholder="净利润（万元）"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:0">今年至今<input type="hidden" data-name="year" value="2015"></td>
                                            <td style="border:0"><input type="text" data-name="income" placeholder="营业额（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="gross_profit" placeholder="毛利润（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="net_profit" placeholder="净利润（万元）"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="am-form-group json-table">
                    <label for="profit_forecast" class="am-u-sm-2 am-form-label">盈利预测</label>
                    <div class="am-u-sm-10">
                        <input type="hidden" class="json-field" name="profit_forecast"/> <!-- 存放JSON -->
                        <div class="am-panel am-panel-default">
                            <div class="am-panel-bd">
                                <table id="cs-table" class="am-table">
                                    <tbody>
                                        <tr>
                                            <td style="border:0">2015年<input type="hidden" data-name="year" value="2015"></td>
                                            <td style="border:0"><input type="text" data-name="income" placeholder="营业额（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="gross_profit" placeholder="毛利润（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="net_profit" placeholder="净利润（万元）"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:0">2016年<input type="hidden" data-name="year" value="2016"></td>
                                            <td style="border:0"><input type="text" data-name="income" placeholder="营业额（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="gross_profit" placeholder="毛利润（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="net_profit" placeholder="净利润（万元）"></td>
                                        </tr>
                                        <tr>
                                            <td style="border:0">2017<input type="hidden" data-name="year" value="2017"></td>
                                            <td style="border:0"><input type="text" data-name="income" placeholder="营业额（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="gross_profit" placeholder="毛利润（万元）"></td>
                                            <td style="border:0"><input type="text" data-name="net_profit" placeholder="净利润（万元）"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <legend>公司信息</legend>
                <div class="am-form-group">
                    <label for="has_company" class="am-u-sm-2 am-form-label">是否已成立公司</label>
                    <div class="am-u-sm-10">
                        <?php echo Form::select('has_company', array('Y'=>'是', 'N'=>'否'));?>
                        <input type="hidden" id="company_info" name="company_info">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="company_name" class="am-u-sm-2 am-form-label">公司名称</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="company_name" name="company_name" placeholder="公司名称">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="legal_person" class="am-u-sm-2 am-form-label">法人代表</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="legal_person" name="legal_person" placeholder="法人代表">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="startup_date" class="am-u-sm-2 am-form-label">成立日期</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="startup_date" name="startup_date" class="am-form-field" placeholder="成立日期" data-am-datepicker="{theme: 'success'}" readonly/>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="registered_address" class="am-u-sm-2 am-form-label">注册地址</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="registered_address" name="registered_address" placeholder="注册地址">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="registered_capital" class="am-u-sm-2 am-form-label">注册资金</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="registered_capital" name="registered_capital" placeholder="注册资金">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="organization_code" class="am-u-sm-2 am-form-label">组织机构代码</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="organization_code" name="organization_code" placeholder="组织机构代码">
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper" >
                    <label for="legal_id_card_path" class="am-u-sm-2 am-form-label">法人身份证</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="legal_id_card">选择文件</div>
                        <input type="hidden" name="legal_id_card"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_legal_id_card" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper" >
                    <label for="legal_cre_rpt_path" class="am-u-sm-2 am-form-label ">法人信用报告</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="legal_cre_rpt">选择文件</div>
                        <input type="hidden" name="legal_cre_rpt"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_legal_cre_rpt" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper" >
                    <label for="biz_lic_path" class="am-u-sm-2 am-form-label">营业执照</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="biz_lic">选择文件</div>
                        <input type="hidden" name="biz_lic"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_biz_lic" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper" >
                    <label for="biz_lic_copy_path" class="am-u-sm-2 am-form-label">营业执照副本</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="biz_lic_copy">选择文件</div>
                        <input type="hidden" name="biz_lic_copy"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_biz_lic_copy" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper" >
                    <label for="tax_reg_card_path" class="am-u-sm-2 am-form-label">税务登记证</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="tax_reg_card">选择文件</div>
                        <input type="hidden" name="tax_reg_card"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_tax_reg_card" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="tax_reg_card_copy_path" class="am-u-sm-2 am-form-label">税务登记证副本</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="tax_reg_card_copy">选择文件</div>
                        <input type="hidden" name="tax_reg_card_copy"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_tax_reg_card_copy" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="org_code_cert_path" class="am-u-sm-2 am-form-label">组织机构代码证</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="org_code_cert">选择文件</div>
                        <input type="hidden" name="org_code_cert"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_org_code_cert" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="org_code_cert_copy_path" class="am-u-sm-2 am-form-label">组织机构代码证副本</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="org_code_cert_copy">选择文件</div>
                        <input type="hidden" name="org_code_cert_copy"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_org_code_cert_copy" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="hyg_lic_path" class="am-u-sm-2 am-form-label">卫生许可证</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="hyg_lic">选择文件</div>
                        <input type="hidden" name="hyg_lic"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_hyg_lic" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="company_photo_path" class="am-u-sm-2 am-form-label">公司照片</label>
                    <div class="am-u-sm-2">
                        <div class="resource-picker" data-res-name="company_photo">选择文件</div>
                        <input type="hidden" name="company_photo"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="rp_company_photo" class="resource-preview"></div>
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

<div id="loading-modal" class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">TITLE</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>

<div id="alert-modal" class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">TITLE</div>
    <div class="am-modal-bd">
      CONTENT
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn">确定</span>
    </div>
  </div>
</div>

@stop

@section('scripts')
<script src="{{{asset('assets/js/json2.js')}}}"></script>
<script src="{{{asset('assets/vendor/kindeditor/kindeditor-min.js')}}}"></script>
<script src="{{{asset('assets/vendor/kindeditor/lang/zh_CN.js')}}}"></script>
<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
<script src="{{{asset('assets/vendor/jcrop/js/jquery.Jcrop.min.js')}}}"></script>
<script>
    var editor;
    KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
            resizeType : 1,
            allowPreviewEmoticons : false,
            allowImageUpload : false,
            items : [
                'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
                'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
                'insertunorderedlist', '|', 'emoticons', 'image', 'link']
        });
    });


    var ModalManager = {
        $loadingModal : $('#loading-modal'),
        $alertModal : $('#alert-modal'),
        showLoadingModal : function(title){
            this.$loadingModal.modal('close');
            this.$loadingModal.find('.am-modal-hd').html(title);
            this.$loadingModal.modal({
                closeViaDimmer : false
            });
        },
        closeLoadingModal : function(){
            this.$loadingModal.modal('close');
        },
        showAlertModal : function(title, content){
            this.$alertModal.find('.am-modal-hd').html(title);
            this.$alertModal.find('.am-modal-bd').html(content);
            this.$alertModal.modal({
                closeViaDimmer : false
            });
        },
        closeAlertModal : function(){
            this.$alertModal.modal('close');
        }

    };

    $(function(){
        //绑定行业选择器事件
        $('#industry_1').on('change', function(){
            var val = $(this).find("option:selected").val();
            if(val == '')
                return;

            $.getJSON(BASE_URL + '/x/get-industry-list', {parent : val}, function(data){
                $("#industry_2").empty();
                data.unshift({industry_code : '', industry_name : '请选择'});
                $.each(data, function(i, item) {
                    $("<option></option>")
                        .val(item["industry_code"])
                        .text(item["industry_name"])
                        .appendTo($("#industry_2"));
                });
            })

        });

        //绑定省份城市选择器事件
        $('#province_code').on('change', function(){
            var val = $(this).find("option:selected").val();
            if(val == '')
                return;

            $.getJSON(BASE_URL + '/x/get-city-list', {province_code : val}, function(data){
                $("#city_code").empty();
                data.unshift({city_code : '', city_name : '请选择'});
                $.each(data, function(i, item) {
                    $("<option></option>")
                        .val(item["city_code"])
                        .text(item["city_name"])
                        .appendTo($("#city_code"));
                });
            })

        });

        $('.json-table input').on('blur.jt', function(){
            var data = [];
            $(this).parents('table').find('tr').each(function(){
                var row = {};
                $(this).find('input').each(function(){
                    row[$(this).attr('data-name')] = $(this).val();
                });
                data.push(row);
            });
            $('.json-table .json-field').val(JSON.stringify(data));

        });

        $('.json-table-add-row').on('click', function(){
            var table_id = $(this).attr('for');
            var li = $('#' + table_id).find('tr').eq(0).clone();
            $('#' + table_id).find('tbody').eq(0).append(li);
        });

        $('.json-table').on('click', '.json-table-del-row', function(){
            $(this).parents('tr').remove();
        });

        var CropManager = {
            $container: $('#crop-container'),
            jcrop_api : null,
            image_path: '',
            init : function(image_path){
                var that = this;
                that.image_path = image_path;
                that.$container.html('<img width="500" src="' + BASE_URL + '/' + image_path + '">');
                that.$container.find('img').Jcrop({
                    boxWidth:500,
                    bgColor:     'black',
                    bgOpacity:   .4,
                    setSelect:   [ 0, 0, 460, 350 ],
                    aspectRatio: 460 / 350,
                    maxSize: [460, 350]

                }, function(){
                    that.jcrop_api = this;
                });

            }
        };

        var cover_uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: BASE_URL + '/assets/vendor/webuploader/Uploader.swf',

            // 文件接收服务端。
            server: BASE_URL + '/x/project-cover-upload',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#cover-picker',

            chunked: false,

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            fileVal: 'project_cover',
            formData: {time: 'xxx'},
            duplicate: true
        });

        cover_uploader.on( 'uploadStart', function( file ) {
            ModalManager.showLoadingModal('正在上传，请稍后...');
        });

        cover_uploader.on( 'uploadError', function( file, reason ) {
            ModalManager.showAlertModal('提示', '上传失败！请重试！');
        });

        cover_uploader.on( 'uploadSuccess', function( file, response ) {
            if(response.errno == 0){
                CropManager.init(response.path);
                $('#cover-editor').modal({
                    onConfirm: function(options) {
                        $.ajax({
                            url: BASE_URL + '/x/project-cover-crop',
                            type: 'POST',
                            data: {path: CropManager.image_path, x:CropManager.jcrop_api.tellSelect().x, y: CropManager.jcrop_api.tellSelect().y, w: CropManager.jcrop_api.tellSelect().w, h: CropManager.jcrop_api.tellSelect().h },
                            async: false,
                            dataType: 'json',
                            success: function(data){
                                if(data.errno == 0){
                                    var imgURL = BASE_URL + '/' + data.path;
                                    $('#project-cover-preview').html('');
                                    $('#project-cover-preview').append('<img width="230" height="175" src="' + imgURL + '" alt="封面预览图" class="am-img-thumbnail"/>');
                                    $('input[name="project_cover"]').val(data.path);
                                }else{
                                    $('#project-cover-preview').html('图片保存失败，请重试');
                                }
                            }
                        });

                    },
                    onCancel: function() {
                       CropManager.jcrop_api.destroy();
                    },
                    closeViaDimmer: false
                });

            }else{
                ModalManager.showAlertModal('提示', '上传失败！请重试！');
            }

        });

        cover_uploader.on( 'uploadComplete', function( file ) {
            ModalManager.closeLoadingModal();
        });

        cover_uploader.on( 'error', function(type ) {
            ModalManager.showAlertModal(type);
        });


        var ResUploaderManager = {
            resUploader: null,
            curResName: '',
            init: function(){
                var me = this;
                var resUploader = WebUploader.create({
                                                        // 选完文件后，是否自动上传。
                                                        auto: true,
                                                        // swf文件路径
                                                        swf: BASE_URL + '/assets/vendor/webuploader/Uploader.swf',
                                                        // 文件接收服务端。
                                                        server: BASE_URL + '/x/project-resource-upload',
                                                        // 选择文件的按钮。可选。
                                                        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                                                        pick: '.resource-picker',
                                                        chunked: false,
                                                        // 只允许选择图片文件。
                                                        accept: {
                                                            title: 'Images',
                                                            extensions: 'gif,jpg,jpeg,bmp,png',
                                                            mimeTypes: 'image/*'
                                                        },
                                                        fileVal: 'res_file',
                                                        formData: {},
                                                        duplicate: true
                                                    });

                resUploader.on( 'uploadStart', function( file ) {
                    ModalManager.showLoadingModal('正在上传，请稍后...');
                });

                resUploader.on( 'uploadError', function( file, reason ) {
                    ModalManager.showAlertModal('提示', '上传失败！请重试！');
                });

                resUploader.on( 'uploadSuccess', function( file, response ) {
                    if(response.errno == 0){
                        $('input[name="' + me.curResName + '"]').val(response.path);
                        var imgURL = BASE_URL + '/' + response.path;
                        $('#rp_'+ me.curResName).html('<img width="230" height="175" src="' + imgURL + '" alt="预览图" class="am-img-thumbnail"/>');
                    }else{
                        ModalManager.showAlertModal('提示', '上传失败！请重试！');
                    }

                });

                resUploader.on( 'uploadComplete', function( file ) {
                    ModalManager.closeLoadingModal();
                });

                resUploader.on( 'error', function(type ) {
                    ModalManager.showAlertModal(type);
                });

                $('.resource-picker').on('click', function(){
                    var curResName = $(this).attr('data-res-name');
                    me.curResName = curResName;
                    resUploader.option.formData = {res_name: curResName};
                });
                
                me.resUploader = resUploader;
            }
        };

        ResUploaderManager.init();

        var aa  =  document.getElementById('hehe');

        alert(aa.innerHTML);






    });



</script>
@stop

