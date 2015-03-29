@extends('layouts.master')

@section('page_title')
注册 - 点投
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
        <strong class="am-text-primary am-text-lg">账户注册</strong>/<small>个人账户</small>
        <hr>
        <div class="am-u-sm-10 am-u-lg-8 am-u-md-8 am-u-sm-centered">
            <div style="height:50px;">
                <ul class="dt-step dt-step-3">
                    <li class="active">1.创建账户</li>
                    <li>2.填写账户信息</li>
                    <li>3.成功</li>
                </ul>
            </div>


            <div class="am-vertical-align" style="height: 250px;">
              <div class="am-vertical-align-middle">
                 我们已经向您的邮箱发送了一份邮件，请点击验证链接继续完成注册，<a href="{{{$mail_host}}}" target="_blank">马上登录邮箱</a>
              </div>
            </div>



        </div>
    </div>
</div>

@stop