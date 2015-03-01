@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-tabs">
		<li><a href="{{{action('IController@getAccountInfo')}}}">基本信息</a></li>
		<li><a href="{{{action('IController@getAccountAuth')}}}">实名认证</a></li>
		<li class="am-active"><a href="{{{action('IController@getAccountPasswd')}}}">密码修改</a></li>
		<li style="float:right">账号信息</li>
	</ul>
@stop
@section('i-content')

<form id="i-passwd-form" action="{{{action('IController@postAccountPasswd')}}}" method="post" class="am-form am-form-horizontal data-am-validator">
	<div class="am-form-group">
		<label for="i-passwd" class="am-u-sm-2 am-form-label">原密码</label>
		<div class="am-u-sm-10">
			<input type="password" id="i-passwd" name="passwd" data-validate-message="请填写原密码" required >
		</div>
	</div>
	<div class="am-form-group">
		<label for="i-newpasswd" class="am-u-sm-2 am-form-label">新密码</label>
		<div class="am-u-sm-10">
			<input type="password" id="i-newpasswd" name="newpasswd" placeholder="请输入新密码（至少6个字符）" data-validate-message="密码格式不正确" minlength="6" pattern="^\w{6,}$" required >
		</div>
	</div>
	<div class="am-form-group">
		<label for="i-newpasswd_confirmation" class="am-u-sm-2 am-form-label">确认密码</label>
		<div class="am-u-sm-10">
			<input type="password" id="i-newpasswd_confirmation" name="newpasswd_confirmation" placeholder="请再输入一次密码" data-equal-to="#i-newpasswd" data-validate-message="两次密码输入不一致" required >
		</div>
	</div>
	
	<button type="submit" class="am-btn am-btn-primary am-center">确 定</button>
</form>

@stop

@section('scripts')
<script>
    $(function(){
		
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

