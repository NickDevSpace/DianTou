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

            <form id="project-create-form" action="/project/create" class="am-form am-form-horizontal">
                <legend>基本信息</legend>
                <div class="am-form-group">
                    <label for="i-project-name" class="am-u-sm-2 am-form-label">项目名称</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="i-project-name" name="project_name" placeholder="输入项目名称" data-validate-message="项目名称不能为空" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-project-cover" class="am-u-sm-2 am-form-label">项目封面</label>
                    <div class="am-u-sm-2">
                         <div id="cover-picker">选择图片</div>
                         <input type="hidden" id="i-project-cover" name="project_cover"/>
                    </div>
                    <div class="am-u-sm-3">
                         <div id="project-cover-preview"></div>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-project-title" class="am-u-sm-2 am-form-label">项目标语</label>
                    <div class="am-u-sm-10">
                        <input type="text" name="project_title" placeholder="输入项目标语" data-validate-message="项目标语不能为空" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-industry-2" class="am-u-sm-2 am-form-label">所属行业</label>
                    <div class="am-u-sm-2">
                        <?php echo Form::amSelect(array('list'=>$industry_select, 'value_field'=>'industry_code','text_field'=>'industry_name', 'header_text' => '请选择', 'id' => 'i-industry-1', 'required' => 'true')); ?>
                    </div>
                    <div class="am-u-sm-2 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_text' => '请选择', 'id' => 'i-industry-2', 'name'=>'industry_code', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-city-code" class="am-u-sm-2 am-form-label">所在城市</label>
                    <div class="am-u-sm-2">
                        <?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'required' => 'true')); ?>
                    </div>
                    <div class="am-u-sm-2 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="address" class="am-u-sm-2 am-form-label">详细地址</label>
                    <div class="am-u-sm-10">
                        <input type="text" id="address" name="address" placeholder="输入详细地址" data-validate-message="项目地址不能为空" required>
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
                <div class="am-form-group">
                    <label for="business_plan_doc" class="am-u-sm-2 am-form-label">项目计划书</label>
                    <div class="am-u-sm-10">
                        <div id="plan-picker" >选择文件</div>
                        <input type="hidden" name="business_plan_doc"/>
                    </div>
                </div>

                <legend>融资需求</legend>
                <div class="am-form-group">
                    <label for="i-total-amt" class="am-u-sm-2 am-form-label">融资总额</label>
                    <div class="am-u-sm-10">
                        <input type="number" id="i-total-amt" name="total_amt" placeholder="填写该项目所需的总资金（元）" data-validate-message="融资总额必须为大于等于1000" min="1000" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-retain-amt" class="am-u-sm-2 am-form-label">项目方出资</label>
                    <div class="am-u-sm-10">
                        <input type="number" id="i-retain-amt" name="retain_amt" placeholder="其中项目方出资金额（元）" data-validate-message="项目方出资金额不能大于融资总额" min="0" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="has_company" class="am-u-sm-2 am-form-label">投资人出资</label>
                    <div class="am-u-sm-10">
                        <input type="number" name="fin_amt"  disabled placeholder="投资人出资（元）">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="has_company" class="am-u-sm-2 am-form-label">认购份数</label>
                    <div class="am-u-sm-10">
                        <input type="number" name="share_count" placeholder="认购份数" data-validate-message="认购份数必须为大于0小于200的整数" min="1" max="200" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="has_company" class="am-u-sm-2 am-form-label">每份金额</label>
                    <div class="am-u-sm-10">
                        <input type="number" name="amt_per_share" placeholder="每份金额" disabled >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="has_company" class="am-u-sm-2 am-form-label">融资期限</label>
                    <div class="am-u-sm-10">
                        <?php echo Form::amSelect(array('list'=>array(array('value'=>'30', 'text'=>'30天'), array('value'=>'60', 'text'=>'60天'), array('value'=>'120', 'text'=>'120天')), 'value_field'=>'value','text_field'=>'text', 'id' => 'fin_days', 'name' => 'fin_days', 'required' => 'true')); ?>
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


    var coverCroper = {
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
    
//    var coverUploader = {
//        init: function(){
//            var cover_uploader = WebUploader.create({
//
//                // 选完文件后，是否自动上传。
//                auto: true,
//
//                // swf文件路径
//                swf: BASE_URL + '/assets/vendor/webuploader/Uploader.swf',
//
//                // 文件接收服务端。
//                server: BASE_URL + '/x/project-cover-upload',
//
//                // 选择文件的按钮。可选。
//                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
//                pick: '#cover-picker',
//
//                chunked: false,
//
//                // 只允许选择图片文件。
//                accept: {
//                    title: 'Images',
//                    extensions: 'gif,jpg,jpeg,bmp,png',
//                    mimeTypes: 'image/*'
//                },
//                fileVal: 'project_cover',
//                formData: {time: 'xxx'},
//                duplicate: true
//            });
//
//            cover_uploader.on( 'uploadStart', function( file ) {
//                ModalManager.showLoadingModal('正在上传，请稍后...');
//            });
//
//            cover_uploader.on( 'uploadError', function( file, reason ) {
//                ModalManager.showAlertModal('提示', '上传失败！请重试！');
//            });
//
//            cover_uploader.on( 'uploadSuccess', function( file, response ) {
//                if(response.errno == 0){
//                    coverCroper.init(response.path);
//                    $('#cover-editor').modal({
//                        onConfirm: function(options) {
//                            $.ajax({
//                                url: BASE_URL + '/x/project-cover-crop',
//                                type: 'POST',
//                                data: {path: coverCroper.image_path, x:coverCroper.jcrop_api.tellSelect().x, y: coverCroper.jcrop_api.tellSelect().y, w: coverCroper.jcrop_api.tellSelect().w, h: coverCroper.jcrop_api.tellSelect().h },
//                                async: false,
//                                dataType: 'json',
//                                success: function(data){
//                                    if(data.errno == 0){
//                                        var imgURL = BASE_URL + '/' + data.path;
//                                        $('#project-cover-preview').html('');
//                                        $('#project-cover-preview').append('<img width="230" height="175" src="' + imgURL + '" alt="封面预览图" class="am-img-thumbnail"/>');
//                                        $('input[name="project_cover"]').val(data.path);
//                                    }else{
//                                        $('#project-cover-preview').html('图片保存失败，请重试');
//                                    }
//                                }
//                            });
//
//                        },
//                        onCancel: function() {
//                           coverCroper.jcrop_api.destroy();
//                        },
//                        closeViaDimmer: false
//                    });
//
//                }else{
//                    ModalManager.showAlertModal('提示', '上传失败！请重试！');
//                }
//
//            });
//
//            cover_uploader.on( 'uploadComplete', function( file ) {
//                ModalManager.closeLoadingModal();
//            });
//
//            cover_uploader.on( 'error', function(type ) {
//                ModalManager.showAlertModal('提示', '操作失败！' + type);
//            });
//        }
//    };



//    var resUploader = {
//        resUploader: null,
//        curResName: '',
//        init: function(){
//            var me = this;
//            var resUploader = WebUploader.create({
//                                                    // 选完文件后，是否自动上传。
//                                                    auto: true,
//                                                    // swf文件路径
//                                                    swf: BASE_URL + '/assets/vendor/webuploader/Uploader.swf',
//                                                    // 文件接收服务端。
//                                                    server: BASE_URL + '/x/project-resource-upload',
//                                                    // 选择文件的按钮。可选。
//                                                    // 内部根据当前运行是创建，可能是input元素，也可能是flash.
//                                                    pick: '.resource-picker',
//                                                    chunked: false,
//                                                    // 只允许选择图片文件。
//                                                    accept: {
//                                                        title: 'Images',
//                                                        extensions: 'gif,jpg,jpeg,bmp,png',
//                                                        mimeTypes: 'image/*'
//                                                    },
//                                                    fileVal: 'res_file',
//                                                    formData: {},
//                                                    duplicate: true
//                                                });
//
//            resUploader.on( 'uploadStart', function( file ) {
//                ModalManager.showLoadingModal('正在上传，请稍后...');
//            });
//
//            resUploader.on( 'uploadError', function( file, reason ) {
//                ModalManager.showAlertModal('提示', '上传失败！请重试！');
//            });
//
//            resUploader.on( 'uploadSuccess', function( file, response ) {
//                if(response.errno == 0){
//                    $('input[name="' + me.curResName + '"]').val(response.path);
//                    var imgURL = BASE_URL + '/' + response.path;
//                    $('#rp_'+ me.curResName).html('<img width="230" height="175" src="' + imgURL + '" alt="预览图" class="am-img-thumbnail"/>');
//                }else{
//                    ModalManager.showAlertModal('提示', '上传失败！请重试！');
//                }
//
//            });
//
//            resUploader.on( 'uploadComplete', function( file ) {
//                ModalManager.closeLoadingModal();
//            });
//
//            resUploader.on( 'error', function(type ) {
//                ModalManager.showAlertModal(type);
//            });
//
//            $('.resource-picker').on('click', function(){
//                var curResName = $(this).attr('data-res-name');
//                me.curResName = curResName;
//                resUploader.option.formData = {res_name: curResName};
//            });
//
//            me.resUploader = resUploader;
//        }
//    };


    var CommonUploader = function(args){

        var defaults = {
                           // 选完文件后，是否自动上传。
                           auto: true,
                           // swf文件路径
                           swf: BASE_URL + '/assets/vendor/webuploader/Uploader.swf',
                           // 文件接收服务端。
                           chunked: false,
                           // 只允许选择图片文件。
                           formData: {},
                           duplicate: true
                       };
        var options = $.extend(defaults, args.options, true);

        var uploader = WebUploader.create(options);

        if(typeof (args.onUploadStart) == 'function'){
            this.cbUploadStart = args.onUploadStart;
        }

        if(typeof (args.onUploadError) == 'function'){
            this.cbUploadError = args.onUploadError;
        }

        if(typeof (args.onUploadSuccess) == 'function'){
            this.cbUploadSuccess = args.onUploadSuccess;
        }

        if(typeof (args.onUploadComplete) == 'function'){
            this.cbUploadComplete = args.onUploadComplete;
        }

        if(typeof (args.onError) == 'function'){
            this.cbError = args.onError;
        }

        uploader.on( 'uploadStart', this.cbUploadStart);

        uploader.on( 'uploadError', this.cbUploadError);

        uploader.on( 'uploadSuccess', this.cbUploadSuccess);

        uploader.on( 'uploadComplete', this.cbUploadComplete);

        uploader.on( 'error', this.cbError);


        this.uploader = uploader;

        if(typeof (args.onCreate) == 'function'){
            args.onCreate.call(uploader);
        }


    };

    CommonUploader.prototype = {
        ctx: {},
        uploader: null,
        cbUploadStart: function( file ) {
           ModalManager.showLoadingModal('正在上传，请稍后...');
        },
        cbUploadError: function( file, reason ) {
           ModalManager.showAlertModal('提示', '上传失败！请重试！');
        },
        cbUploadSuccess: function( file, response ) {
            if(response.errno == 0){
                ModalManager.showAlertModal('提示', '上传成功！');
            }else{
                ModalManager.showAlertModal('提示', '上传失败！请重试！');
            }
        },
        cbUploadComplete: function(file){
            ModalManager.closeLoadingModal();
        },
        cbError: function(error){
            ModalManager.showAlertModal('错误', type);
        }

    }




    $(function(){

        //绑定行业选择器事件
        $('#i-industry-1').on('change', function(){
            var val = $(this).find("option:selected").val();
            if(val == ''){
				$("#i-industry-2").empty();
				$("<option></option>").val('').text('请选择').appendTo($("#i-industry-2"));
				return;
			}

            $.getJSON(BASE_URL + '/x/get-industry-list', {parent : val}, function(data){
                $("#i-industry-2").empty();
                data.unshift({industry_code : '', industry_name : '请选择'});
                $.each(data, function(i, item) {
                    $("<option></option>")
                        .val(item["industry_code"])
                        .text(item["industry_name"])
                        .appendTo($("#i-industry-2"));
                });
            })

        });

        //绑定省份城市选择器事件
        $('#i-province-code').on('change', function(){
            var val = $(this).find("option:selected").val();
            if(val == ''){
				$("#i-city-code").empty();
				$("<option></option>").val('').text('请选择').appendTo($("#i-city-code"));
				return;
			}

            $.getJSON(BASE_URL + '/x/get-city-list', {province_code : val}, function(data){
                $("#i-city-code").empty();
                data.unshift({city_code : '', city_name : '请选择'});
                $.each(data, function(i, item) {
                    $("<option></option>")
                        .val(item["city_code"])
                        .text(item["city_name"])
                        .appendTo($("#i-city-code"));
                });
            })

        });

        //自动计算融资需求
        $('input[name="total_amt"], input[name="retain_amt"], input[name="share_count"]').on('keyup', function(){
            var total_amt = $('input[name="total_amt"]').val();
            var retain_amt = $('input[name="retain_amt"]').val();
            var share_count = $('input[name="share_count"]').val();
            var fin_amt = total_amt - retain_amt;
            var amt_per_share = (fin_amt / share_count).toFixed(2);
            $('input[name="fin_amt"]').val(fin_amt);
            $('input[name="amt_per_share"]').val(amt_per_share);
        });


        //coverUploader.init();
        //resUploader.init();

        var cover_args = {
            options: {
                server: BASE_URL + '/x/project-cover-upload',
                pick: '#cover-picker',
                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                },
                fileVal: 'project_cover',
                formData: {time: 'xxx'}
            },
            onUploadSuccess: function(file, response){
                if(response.errno == 0){
                    coverCroper.init(response.path);
                    $('#cover-editor').modal({
                        onConfirm: function(options) {
                            $.ajax({
                                url: BASE_URL + '/x/project-cover-crop',
                                type: 'POST',
                                data: {path: coverCroper.image_path, x:coverCroper.jcrop_api.tellSelect().x, y: coverCroper.jcrop_api.tellSelect().y, w: coverCroper.jcrop_api.tellSelect().w, h: coverCroper.jcrop_api.tellSelect().h },
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
                           coverCroper.jcrop_api.destroy();
                        },
                        closeViaDimmer: false
                    });

                }else{
                    ModalManager.showAlertModal('提示', '上传失败！请重试！');
                }
            }
        }

        var coverUploader = new CommonUploader(cover_args);

        var plan_args = {
            options: {
                server: BASE_URL + '/x/project-resource-upload',
                pick: '#plan-picker',
                accept: {
                    title: '文档',
                    extensions: 'doc,docx,ppt,pptx,pdf,txt',
                    mimeTypes: 'application/msword, application/pdf, application/vnd.ms-powerpoint, plain/text'
                },
                fileVal: 'res_file',
                formData:{res_type:'docs'}
            },
            onUploadSuccess: function( file, response ){
                var me = this;
                if(response.errno == 0){
                    ModalManager.showAlertModal('提示', '上传成功！');
                }else{
                    ModalManager.showAlertModal('提示', '上传失败！请重试！');
                }
            }
        };

        var planUploader = new CommonUploader(plan_args);



        var res_args = {
                    options: {
                        server: BASE_URL + '/x/project-resource-upload',
                        pick: '.resource-picker',
                        accept: {
                            title: 'Images',
                            extensions: 'gif,jpg,jpeg,bmp,png',
                            mimeTypes: 'image/*'
                        },
                        fileVal: 'res_file'
                    },
                    onCreate: function(){
                        var me = this;
                        $('.resource-picker').on('click', function(){
                            var curResName = $(this).attr('data-res-name');
                            me.curResName = curResName;
                            me.options.formData = {res_name: curResName};
                        });
                    },
                    onUploadSuccess: function( file, response ){
                        var me = this;
                        if(response.errno == 0){
                            $('input[name="' + me.curResName + '"]').val(response.path);
                            var imgURL = BASE_URL + '/' + response.path;
                            $('#rp_'+ me.curResName).html('<img width="230" height="175" src="' + imgURL + '" alt="预览图" class="am-img-thumbnail"/>');
                        }else{
                            ModalManager.showAlertModal('提示', '上传失败！请重试！');
                        }
                    }
                };

        var resUploader = new CommonUploader(res_args);
		
		$('#project-create-form').validator({
			
			markValid: function(validity) {
			// this is Validator instance
				var options = this.options;
				var $field = $(validity.field);

				$field.addClass(options.validClass).removeClass(options.inValidClass);
				
				var fieldWrapper = $(validity.field).closest('div');
				fieldWrapper.find('.am-text-danger').remove();
				options.onValid.call(this, validity);
			},

			markInValid: function(validity) {
				var options = this.options;
				var $field = $(validity.field);

				$field.addClass(options.inValidClass + ' ' + options.activeClass).removeClass(options.validClass);
				
				var fieldWrapper = $(validity.field).closest('div');
				var validateMessage = $(validity.field).attr('data-validate-message') || '';
				fieldWrapper.find('.am-text-danger').remove();
				$('<span class="am-text-danger">'+validateMessage+'</span>').appendTo(fieldWrapper);
				
				options.onInValid.call(this, validity);
			},
			validate: function(validity) {
				var $e = $(validity.field);
				var v = $e.val();
				
				if($e.is('#i-retain-amt')){
					v = Number(v);
					var t = Number($('#i-total-amt').val());
					if(v > t){
						validity.valid = false;
					}
				}
				
				
			},
		});

    });





</script>
@stop

