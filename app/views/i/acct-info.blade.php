@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-tabs">
		<li class="am-active"><a href="{{{action('IController@getAccountInfo')}}}">基本信息</a></li>
		<li><a href="{{{action('IController@getAccountAuth')}}}">实名认证</a></li>
		<li><a href="{{{action('IController@getAccountPasswd')}}}">密码修改</a></li>
		<li style="float:right">账号信息</li>
	</ul>
@stop
@section('i-content')

<form id="i-info-form" action="{{{action('IController@postAccountInfo')}}}" method="post" class="am-form am-form-horizontal">
	<div class="am-form-group">
		<label for="i-project-name" class="am-u-sm-2 am-form-label">昵称</label>
		<div class="am-u-sm-10">
			<input type="text" id="i-nickname" name="nickname" value="{{{$user->nickname}}}" placeholder="给自己取个昵称吧" data-validate-message="请填写昵称" required >
		</div>
	</div>
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
	<div class="am-form-group">
		<label for="i-city-code" class="am-u-sm-2 am-form-label">所在城市</label>
		<div class="am-u-sm-2">
			<?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'required' => 'true', 'selected'=>$user->province_code)); ?>
		</div>
		<div class="am-u-sm-2 am-u-end">
			<?php echo Form::amSelect(array('list'=>$city_select, 'value_field'=>'city_code','text_field'=>'city_name', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'required' => 'true', 'selected'=>$user->city_code)); ?>
		</div>
	</div>
	<div class="am-form-group">
		<label for="address" class="am-u-sm-2 am-form-label">联系地址</label>
		<div class="am-u-sm-10">
			<input type="text" id="address" name="address" value="{{{$user->address}}}" placeholder="您的联系地址" data-validate-message="">
		</div>
	</div>
	
	<button type="submit" class="am-btn am-btn-primary am-center">确 定</button>
</form>

@stop

@section('page_scripts')
<script>
    $(function(){
		
		//绑定省份城市选择器事件
        $('#i-province-code').on('change', function(){
            var val = $(this).find("option:selected").val();
            if(val == ''){
				$("#i-city-code").empty();
				$("<option></option>").val('').text('请选择').appendTo($("#i-city-code"));
				return;
			}

            $.getJSON(BASE_URL + '/x/get-city-list', {province_code : val}, function(data){
                $("#i-city-code").empty();
                data.unshift({city_code : '', city_name : '请选择'});
                $.each(data, function(i, item) {
                    $("<option></option>")
                        .val(item["city_code"])
                        .text(item["city_name"])
                        .appendTo($("#i-city-code"));
                });
            })

        });
        
		
		
			
		
		
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

