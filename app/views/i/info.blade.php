@extends('layouts.master')
@section('page_title')
个人中心 | 点投
@stop
@section('head')
    <link rel="stylesheet" href="{{{asset('assets/vendor/kindeditor/themes/default/default.css')}}}"/>
    <link rel="stylesheet" href="{{{asset('assets/vendor/jcrop/css/jquery.Jcrop.css')}}}"/>
    <style>
        .content-wrapper {
            padding: 35px 0;
        }
		
		.p-content{
			margin-top:40px;
		}



    </style>

@stop
@section('content')


<div class="content-wrapper">
        <div class="am-container">
			
            <div class="am-u-sm-3">
				<div style="margin-top:40px;">
					<img src="https://avatars2.githubusercontent.com/u/6135346?v=3&s=460" width="230" height="230" class="am-img-thumbnail"/>
					<p class="am-center">Steve Nash</p>
				</div>
				<div>
					<ul class="am-nav">
					  <li class="am-active"><a href="#"><span class="am-icon-user"></span> &nbsp;个人信息</a></li>
					  <li><a href="#"><span class="am-icon-star-o"></span> &nbsp;项目</a></li>
					  <li><a href="#"><span class="am-icon-envelope-o"></span> &nbsp;消息</a></li>
					</ul>

				</div>
			</div>
			<div class="am-u-sm-9">
				
				<div class="p-nav">
					<ul class="am-nav am-nav-tabs">
						<li class="am-active"><a href="{{{action('IController@getInfo')}}}">信息修改</a></li>
						<li><a href="{{{action('IController@getAuth')}}}">实名认证</a></li>
						<li><a href="{{{action('IController@getPasswd')}}}">密码修改</a></li>
						<li style="float:right">个人信息</li>
					</ul>
					
				</div>
				
				<div class="p-content">
					<form id="i-info-form" action="{{{action('IController@postInfo')}}}" method="post" class="am-form am-form-horizontal">
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
				</div>
			</div>
        </div>
		
</div>

@stop

@section('scripts')
<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
<script src="{{{asset('assets/vendor/jcrop/js/jquery.Jcrop.min.js')}}}"></script>
<script>
    
    var CommonUploader = function(args){

        var defaults = {
                           // 选完文件后，是否自动上传。
                           auto: true,
                           // swf文件路径
                           swf: BASE_URL + '/assets/vendor/webuploader/Uploader.swf',
                           // 文件接收服务端。
                           chunked: false,
                           // 只允许选择图片文件。
                           formData: {},
                           duplicate: true
                       };
        var options = $.extend(defaults, args.options, true);

        var uploader = WebUploader.create(options);

        if(typeof (args.onUploadStart) == 'function'){
            this.cbUploadStart = args.onUploadStart;
        }

        if(typeof (args.onUploadError) == 'function'){
            this.cbUploadError = args.onUploadError;
        }

        if(typeof (args.onUploadSuccess) == 'function'){
            this.cbUploadSuccess = args.onUploadSuccess;
        }

        if(typeof (args.onUploadComplete) == 'function'){
            this.cbUploadComplete = args.onUploadComplete;
        }

        if(typeof (args.onError) == 'function'){
            this.cbError = args.onError;
        }

        uploader.on( 'uploadStart', this.cbUploadStart);

        uploader.on( 'uploadError', this.cbUploadError);

        uploader.on( 'uploadSuccess', this.cbUploadSuccess);

        uploader.on( 'uploadComplete', this.cbUploadComplete);

        uploader.on( 'error', this.cbError);


        this.uploader = uploader;

        if(typeof (args.onCreate) == 'function'){
            args.onCreate.call(uploader);
        }


    };

    CommonUploader.prototype = {
        ctx: {},
        uploader: null,
        cbUploadStart: function( file ) {
           ModalManager.showLoadingModal('正在上传，请稍后...');
        },
        cbUploadError: function( file, reason ) {
           ModalManager.showAlertModal('提示', '上传失败！请重试！');
        },
        cbUploadSuccess: function( file, response ) {
            if(response.errno == 0){
                ModalManager.showAlertModal('提示', '上传成功！');
            }else{
                ModalManager.showAlertModal('提示', '上传失败！请重试！');
            }
        },
        cbUploadComplete: function(file){
            ModalManager.closeLoadingModal();
        },
        cbError: function(error){
            ModalManager.showAlertModal('错误', type);
        }

    }




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

