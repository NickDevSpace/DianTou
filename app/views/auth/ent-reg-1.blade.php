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
        <strong class="am-text-primary am-text-lg">账户注册</strong>
        <hr>
        <div class="am-u-sm-10 am-u-lg-8 am-u-md-8 am-u-sm-centered">
            <div style="height:50px;">
                <ul class="dt-step dt-step-3">
                    <li class="active">1.创建账户</li>
                    <li>2.填写账户信息</li>
                    <li>3.成功</li>
                </ul>
            </div>

            <ul class="am-nav am-nav-tabs am-nav-justify">
                <li><a href="{{{action('AuthController@getReg')}}}">个人账户</a></li>
                <li class="am-active"><a href="#">企业账户</a></li>
            </ul>

            <form action="{{{action('AuthController@postEntReg')}}}" method="post" class="am-form am-form-horizontal" style="margin-top:50px;">
                <div class="am-form-group">
                    <label for="i-account" class="am-u-sm-3 am-form-label">电子邮箱：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="email" id="i-account" name="account" placeholder="" data-validate-message="" required >
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
                        <button type="submit" class="am-btn am-btn-success am-btn-block">下一步</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

@stop

@section('page_js')
<script>
    $(function(){


    });

</script>
@stop