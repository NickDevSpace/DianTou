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
        <strong class="am-text-primary am-text-lg">实名认证</strong>/<small>个人</small>
        <hr>
        <div class="am-u-sm-10 am-u-lg-8 am-u-md-8 am-u-sm-centered">

            <form action="{{{action('AuthController@postPrivAuth')}}}" method="post" class="am-form am-form-horizontal" style="margin-top:50px;">
                <div class="am-form-group">
                    <label for="i-real-name" class="am-u-sm-3 am-form-label">真实姓名：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-real-name" name="real_name" placeholder="" data-validate-message="" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-project-name" class="am-u-sm-3 am-form-label">性别：</label>
                    <div class="am-u-sm-6 am-u-end">
                              <label class="am-radio-inline">
                                <input type="radio"  value="M" name="sex"> 男
                              </label>
                              <label class="am-radio-inline">
                                <input type="radio" value="F" name="sex"> 女
                              </label>
                              <label class="am-radio-inline">
                                <input type="radio" value="S" name="sex" checked="checked"> 保密
                              </label>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-birthday" class="am-u-sm-3 am-form-label">生日：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-birthday" name="birthday" class="am-form-field" placeholder="出生日期" data-am-datepicker="{theme: 'success'}" readonly/>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-address" class="am-u-sm-3 am-form-label">联系地址：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-address" name="address" class="am-form-field" placeholder="填写您的常用联系地址，以便点投和你联系"/>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-crdt-id" class="am-u-sm-3 am-form-label">身份证号：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="text" id="i-crdt-id" name="crdt_id"  placeholder="请输入您的身份证号码" data-validate-message="身份证号码格式不正确" required >
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="i-crdt-photo-a" class="am-u-sm-3 am-form-label">身份证正面：</label>
                    <div class="am-u-sm-3 am-u-end">
                        <div class="resource-picker" data-res-name="crdt_photo_a">选择文件</div>
                        <input type="hidden" name="crdt_photo_a"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                         <div id="rp_crdt_photo_a" class="resource-preview"></div>
                    </div>
                </div>
                <div class="am-form-group resource-upload-wrapper">
                    <label for="i-crdt-photo-b" class="am-u-sm-3 am-form-label">身份证反面：</label>
                    <div class="am-u-sm-3 am-u-end">
                        <div class="resource-picker" data-res-name="crdt_photo_b">选择文件</div>
                        <input type="hidden" name="crdt_photo_b"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                         <div id="rp_crdt_photo_b" class="resource-preview"></div>
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