@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-tabs">
		<li><a href="{{{action('IController@getAccountInfo')}}}">基本信息</a></li>
		<li class="am-active"><a href="{{{action('IController@getAccountAuth')}}}">实名认证</a></li>
		<li><a href="{{{action('IController@getAccountPasswd')}}}">密码修改</a></li>
		<li style="float:right">账号信息</li>
	</ul>
@stop
@section('i-content')

<form id="i-passwd-form" action="{{{action('IController@postAccountAuth')}}}" method="post" class="am-form am-form-horizontal data-am-validator">
	<div class="am-form-group">
		<label for="i-real-name" class="am-u-sm-2 am-form-label">真实姓名</label>
		<div class="am-u-sm-10">
			<input type="text" id="i-real-name" name="real_name" value="{{{$user->real_name}}}" placeholder="请输入您的真实姓名" data-validate-message="请填写原密码" required >
		</div>
	</div>
	<div class="am-form-group">
		<label for="i-mobile" class="am-u-sm-2 am-form-label">手机号码</label>
		<div class="am-u-sm-10">
			<input type="text" id="i-mobile"  value="{{{$user->mobile}}}" data-validate-message="请填写原密码" readonly="true" required >
		</div>
	</div>
	<div class="am-form-group">
		<label for="i-crdt-id" class="am-u-sm-2 am-form-label">身份证号</label>
		<div class="am-u-sm-10">
			<input type="password" id="i-crdt-id" name="crdt_id" value="{{{$user->crdt_id}}}" placeholder="请输入您的身份证号码" data-validate-message="身份证号码格式不正确" required >
		</div>
	</div>
	<div class="am-form-group resource-upload-wrapper">
		<label for="i-crdt-photo-a" class="am-u-sm-2 am-form-label">身份证正面</label>
		<div class="am-u-sm-2">
			<div class="resource-picker" data-res-name="crdt_photo_a">选择文件</div>
			<input type="hidden" name="crdt_photo_a" value="{{{$user->crdt_photo_a}}}"/>
		</div>
		<div class="am-u-sm-3">
			 <div id="rp_crdt_photo_a" class="resource-preview"></div>
		</div>
	</div>
	<div class="am-form-group resource-upload-wrapper">
		<label for="i-crdt-photo-b" class="am-u-sm-2 am-form-label">身份证反面</label>
		<div class="am-u-sm-2">
			<div class="resource-picker" data-res-name="crdt_photo_b">选择文件</div>
			<input type="hidden" name="crdt_photo_b" value="{{{$user->crdt_photo_b}}}"/>
		</div>
		<div class="am-u-sm-3">
			 <div id="rp_crdt_photo_b" class="resource-preview"></div>
		</div>
	</div>
	
	<button type="submit" class="am-btn am-btn-primary am-center">提交审核</button>
</form>

@stop

@section('page_scripts')
<script>
    $(function(){
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
                            App.ModalManager.showAlertModal('提示', '上传失败！请重试！');
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

