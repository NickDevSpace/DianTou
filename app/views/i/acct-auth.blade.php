@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
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
			<input type="text" id="i-real-name" name="real_name" value="{{{$user->real_name}}}" placeholder="请输入您的真实姓名" data-validate-message="姓名格式不正确" required >
		</div>
	</div>
	<div class="am-form-group">
		<label for="i-crdt-id" class="am-u-sm-2 am-form-label">身份证号</label>
		<div class="am-u-sm-10">
			<input type="text" id="i-crdt-id" name="crdt_id" value="{{{$user->crdt_id}}}" placeholder="请输入您的身份证号码" data-validate-message="身份证号码格式不正确" required >
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
	<div class="am-form-group">
		<label for="i-mobile" class="am-u-sm-2 am-form-label">手机号码</label>
		<div class="am-u-sm-10">
			<input type="text" id="i-mobile"  name="mobile" value="{{{$user->mobile}}}" data-validate-message="输入真实的手机号码" required >
		</div>
	</div>
	<div class="am-form-group">
        <label for="i-v-code" class="am-u-sm-2 am-form-label">验证码</label>
        <div class="am-u-sm-2">
            <input type="text" id="i-v-code"  name="v_code" value="" data-validate-message="输入短信中的验证码" required >
        </div>
        <div class="am-u-sm-8 am-u-end"><button type="button" class="v-code-btn am-btn am-btn-primary">获取验证码</button></div>
    </div>
    <div class="am-form-group">
        <label for="i-v-code" class="am-u-sm-2 am-form-label">验证码</label>
        <div class="am-u-sm-10 " style="padding-top:0.6em">
            哈哈哈我额发了就可我见附件为Elf
        </div>
    </div>
	<button type="submit" class="am-btn am-btn-primary am-center">提交审核</button>
</form>

@stop

@section('page_scripts')
<script>
    $(function(){
		App.init(['i.acct.auth']);
    });





</script>
@stop

