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
<?php $user = Auth::user(); ?>
<form id="i-passwd-form"  class="am-form am-form-horizontal data-am-validator">
    <div class="am-u-sm-12">
        <div style="height: 200px; text-align:center">
	@if(Auth::user()->verification_state == '1')
	    您尚未进行实名认证，通过实名认证，就可以发起众筹项目或投资您喜欢的项目了哦！<br/><br/>
	    <a class="am-btn am-btn-success am-vertical-align-middle" href="@if($user->user_type == '1'){{{action('AuthController@getPrivAuth')}}}@else{{{action('AuthController@getEntAuth')}}}@endif">申请实名认证</a>
    @elseif(Auth::user()->verification_state == '2')
        您的实名认证正在审核中，请耐心等待！<br/><br/>
    @elseif(Auth::user()->verification_state == '3')
        很遗憾！您的实名认证未通过审核，您可以重新填写并申请，通过实名认证，就可以发起众筹项目或投资您喜欢的项目了哦！<br/><br/>
        <a class="am-btn am-btn-success" href="@if($user->user_type == '1'){{{action('AuthController@getPrivAuth')}}}@else{{{action('AuthController@getEntAuth')}}}@endif">重新申请实名认证</a>
    @else
        <div class="am-g am-margin-top">
          <div class="am-u-sm-3 am-text-right"><label>认证状态</label></div>
          <div class="am-u-sm-9 am-text-left">
                已认证
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-3 am-text-right"><label>真实姓名</label></div>
          <div class="am-u-sm-9 am-text-left">
                {{{$user->userinfo['real_name']}}}
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-3 am-text-right"><label>手机号</label></div>
          <div class="am-u-sm-9 am-text-left">
                {{{$user->userinfo['mobile']}}} <a href="#" style="margin-left:20px;">修改</a>
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-3 am-text-right"><label>联系地址</label></div>
          <div class="am-u-sm-9 am-text-left">
                {{{$user->userinfo['address']}}}
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-3 am-text-right"><label>生日</label></div>
          <div class="am-u-sm-9 am-text-left">
                {{{$user->userinfo['birthday']}}}
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-3 am-text-right"><label>性别</label></div>
          <div class="am-u-sm-9 am-text-left">
                @if($user->userinfo['sex'] == '1')
                    男
                @elseif($user->userinfo['sex'] == '2')
                    女
                @else
                    保密
                @endif
          </div>
        </div>
        <div class="am-g am-margin-top">
          <div class="am-u-sm-3 am-text-right"><label>身份证号码</label></div>
          <div class="am-u-sm-9 am-text-left">
                {{{$user->userinfo['crdt_id']}}}
          </div>
        </div>

    @endif
        </div>
    </div>
</form>

@stop

@section('page_js')
<script>
    $(function(){
		App.init(['i.acct.auth']);
    });





</script>
@stop

