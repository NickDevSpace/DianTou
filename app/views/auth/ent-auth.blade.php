@extends('layouts.master')

@section('page_title')
实名认证 - 点投
@stop
@section('head')
<style>
    .content-wrapper {
		padding: 35px 0 200px 0;
	}
</style>
@stop

@section('content')
<div class="content-wrapper">
    <div class="am-container">
        <strong class="am-text-primary am-text-lg">实名认证</strong>/<small> 企业</small>
        <hr>
        <div class="am-u-sm-10 am-u-lg-8 am-u-md-8 am-u-sm-centered">

            <form action="{{{action('AuthController@postEntAuth')}}}" method="post" class="am-form am-form-horizontal" style="margin-top:50px;">
                <div class="am-form-group">
                    <label for="i-company_name" class="am-u-sm-3 am-form-label"><span class="required">*</span>公司名称：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-company_name" name="company_name" placeholder="企业名称必须与营业执照上的名称一致" data-validate-message="" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-startup-dt" class="am-u-sm-3 am-form-label"><span class="required">*</span>成立日期：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-startup-dt" name="startup_dt" class="am-form-field" placeholder="成立日期" data-am-datepicker="{theme: 'success'}" readonly/>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-legal-name" class="am-u-sm-3 am-form-label"><span class="required">*</span>法人代表姓名：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-legal-name" name="legal_name" placeholder="法人代表姓名" data-validate-message="" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-legal-crdt-id" class="am-u-sm-3 am-form-label"><span class="required">*</span>法人身份证号：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-legal-crdt-id" name="legal_crdt_id"  placeholder="法人身份证号" data-validate-message="身份证号码格式不正确" required >
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="i-legal-crdt-photo-a" class="am-u-sm-3 am-form-label"><span class="required">*</span>法人身份证正面：</label>
                    <div class="am-u-sm-3 am-u-end">
                        <div class="resource-picker" data-res-name="legal_crdt_photo_a">选择文件</div>
                        <input type="hidden" name="legal_crdt_photo_a"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                         <div id="rp_legal_crdt_photo_a" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="i-legal-crdt-photo-b" class="am-u-sm-3 am-form-label"><span class="required">*</span>法人身份证反面：</label>
                    <div class="am-u-sm-3 am-u-end">
                        <div class="resource-picker" data-res-name="legal_crdt_photo_b">选择文件</div>
                        <input type="hidden" name="legal_crdt_photo_b"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                         <div id="rp_legal_crdt_photo_b" class="resource-preview"></div>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-biz-lic-id" class="am-u-sm-3 am-form-label"><span class="required">*</span>营业执照注册号：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-biz-lic-id" name="biz_lic_id" placeholder="营业执照注册号" data-validate-message="" required >
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-biz-exp-dt" class="am-u-sm-3 am-form-label"><span class="required">*</span>营业期限：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-biz-exp-dt" name="biz_exp_dt" class="am-form-field" placeholder="营业期限" data-am-datepicker="{theme: 'success'}" readonly/>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-address" class="am-u-sm-3 am-form-label"><span class="required">*</span>常用地址：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-address" name="address" placeholder="常用地址" data-validate-message="" required >
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-telephone" class="am-u-sm-3 am-form-label"><span class="required">*</span>联系电话：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-telephone" name="telephone" placeholder="联系电话" data-validate-message="" required >
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-biz-lic-addr" class="am-u-sm-3 am-form-label"><span class="required">*</span>营业执照所在地：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-biz-lic-addr" name="biz_lic_addr" placeholder="营业执照所在地" data-validate-message="" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-business-scope" class="am-u-sm-3 am-form-label"><span class="required">*</span>营业范围：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-business-scope" name="business_scope" placeholder="营业范围" data-validate-message="" required >
                    </div>
                </div>

                <div class="am-form-group resource-upload-wrapper">
                    <label for="i-biz-lic-photo" class="am-u-sm-3 am-form-label"><span class="required">*</span>营业执照副本扫描件：</label>
                    <div class="am-u-sm-3 am-u-end">
                        <div class="resource-picker" data-res-name="biz_lic_photo">选择文件</div>
                        <input type="hidden" name="biz_lic_photo"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                         <div id="rp_biz_lic_photo" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="i-biz-lic-photo-sealed" class="am-u-sm-3 am-form-label"><span class="required">*</span>加盖公章的副本：</label>
                    <div class="am-u-sm-3 am-u-end">
                        <div class="resource-picker" data-res-name="biz_lic_photo_sealed">选择文件</div>
                        <input type="hidden" name="biz_lic_photo_sealed"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                         <div id="rp_biz_lic_photo_sealed" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-org-code" class="am-u-sm-3 am-form-label">组织机构代码：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-org-code" name="org_code" placeholder="组织机构代码" data-validate-message="" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-reg-capital" class="am-u-sm-3 am-form-label">注册资金：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-reg-capital" name="reg_capital" placeholder="注册资金，单位万元" data-validate-message="" required >
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
                    <div class="am-u-sm-6 am-u-sm-centered">
                        <button type="submit" class="am-btn am-btn-success am-btn-block">提交审核</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

@stop
@section('vendor_js')
<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
@stop
@section('page_js')
<script>
    $(function(){
        //点击发送短信验证码
        $('.v-code-btn').click(function () {
            var $btn = $(this);
            var mobile = $("input[name='account']").val();
            App.Common.SMSVerification.sendVCode(mobile, $btn);
        });

        //增加上传按钮的绑定
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
                    _App.Common.ModalManager.showAlertModal('提示', '上传失败！请重试！');
                }
            }
        };

        var resUploader = new CommonUploader(res_args);
    });

</script>
@stop