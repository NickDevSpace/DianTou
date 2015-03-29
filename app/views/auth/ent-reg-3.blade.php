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
                    <li>1.创建账户</li>
                    <li class="active">2.填写账户信息</li>
                    <li>3.成功</li>
                </ul>
            </div>

            <form action="{{{action('AuthController@postSaveEntAcct')}}}" method="post" class="am-form am-form-horizontal" style="margin-top:50px;">
                <div class="am-form-group">
                    <label for="i-account" class="am-u-sm-3 am-form-label">账号：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <div class="dt-form-desc">{{{$account}}}</div>
                        <input type="hidden" name="account" value="{{{$account}}}">
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-passwd" class="am-u-sm-3 am-form-label">密码：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="password" id="i-passwd" name="password" placeholder="请输入密码（至少6个字符）" data-validate-message="密码格式不正确" minlength="6" pattern="^\w{6,}$" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-passwd_confirmation" class="am-u-sm-3 am-form-label">确认密码：</label>
                    <div class="am-u-sm-6 am-u-end">
                        <input type="password" id="i-passwd_confirmation" name="password_confirmation" placeholder="请再输入一次密码" data-equal-to="#i-passwd" data-validate-message="两次密码输入不一致" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-city-code" class="am-u-sm-3 am-form-label">所在城市：</label>
                    <div class="am-u-sm-2">
                        <?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'required' => 'true')); ?>
                    </div>
                    <div class="am-u-sm-2 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-6 am-u-sm-centered">
                        <button type="submit" class="am-btn am-btn-success am-btn-block">提交</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

@stop