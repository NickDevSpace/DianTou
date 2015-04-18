@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
    <ul class="am-nav am-nav-pills">
        <li class="am-active"><a href="{{{action('IController@getAccountInfo')}}}">基本信息</a></li>
        <li><a href="{{{action('IController@getAccountAuth')}}}">实名认证</a></li>
        <li><a href="{{{action('IController@getAccountPasswd')}}}">密码修改</a></li>
    </ul>
@stop
@section('i-content')

<form id="i-info-form" action="{{{action('IController@postAccountInfo')}}}" method="post" class="am-form am-form-horizontal">
    <div class="am-form-group">
        <label for="i-account" class="am-u-sm-2 am-form-label">账号：</label>
        <div class="am-u-sm-6 am-u-end">
            <div class="dt-form-desc">{{{Auth::user()->account}}}</div>
        </div>
    </div>
    <div class="am-form-group">
        <label for="i-account" class="am-u-sm-2 am-form-label">账号类型：</label>
        <div class="am-u-sm-6 am-u-end">
            <div class="dt-form-desc">@if(Auth::user()->user_type == '1')个人@else企业@endif</div>
        </div>
    </div>
	<div class="am-form-group">
		<label for="i-project-name" class="am-u-sm-2 am-form-label">昵称：</label>
		<div class="am-u-sm-6 am-u-end">
			<input type="text" id="i-nickname" name="nickname" value="{{{$user->nickname}}}" placeholder="给自己取个昵称吧" data-validate-message="请填写昵称" required >
		</div>
	</div>
	<!--
	<div class="am-form-group">
		<label for="i-project-name" class="am-u-sm-2 am-form-label">电子邮箱</label>
		<div class="am-u-sm-10">
			<input type="email" id="i-email" name="email" value="{{{$user->email}}}" placeholder="请输入常用邮箱" data-validate-message="邮箱格式错误" required >
		</div>
	</div>
	<div class="am-form-group">
		<label for="i-project-name" class="am-u-sm-2 am-form-label">性别</label>
		<div class="am-u-sm-10">
				  <label class="am-radio-inline">
					<input type="radio"  value="M" name="sex" @if ($user->sex === 'M') checked="checked" @endif> 男
				  </label>
				  <label class="am-radio-inline">
					<input type="radio" value="F" name="sex" @if ($user->sex === 'F') checked="checked" @endif> 女
				  </label>
				  <label class="am-radio-inline">
					<input type="radio" value="S" name="sex" @if ($user->sex === 'S') checked="checked" @endif> 保密
				  </label>
		</div>
	</div>
	-->
	<div class="am-form-group">
		<label for="i-city-code" class="am-u-sm-2 am-form-label">所在城市：</label>
		<div class="am-u-sm-2">
			<?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'required' => 'true', 'selected'=>$user->province_code)); ?>
		</div>
		<div class="am-u-sm-2 am-u-end">
			<?php echo Form::amSelect(array('list'=>$city_select, 'value_field'=>'city_code','text_field'=>'city_name', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'required' => 'true', 'selected'=>$user->city_code)); ?>
		</div>
	</div>
	<!--
	<div class="am-form-group">
		<label for="address" class="am-u-sm-2 am-form-label">联系地址</label>
		<div class="am-u-sm-10">
			<input type="text" id="address" name="address" value="{{{$user->address}}}" placeholder="您的联系地址" data-validate-message="">
		</div>
	</div>
	-->
	<button type="submit" class="am-btn am-btn-success am-center">保存修改</button>
</form>

@stop

@section('page_js')
<script>
    $(function(){
		
		App.init(['i.acct.info']);
        
    });





</script>
@stop

