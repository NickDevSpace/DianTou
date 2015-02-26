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
						<li class="am-active"><a href="#">信息修改</a></li>
						<li><a href="#">实名认证</a></li>
						<li><a href="#">密码修改</a></li>
						<li style="float:right">个人信息</li>
					</ul>
					
				</div>
				
				<div class="p-content">
					<form id="user-info-form" action="{{{action('UserController@postSaveUserInfo')}}}" method="post" class="am-form am-form-horizontal">
						<div class="am-form-group">
							<label for="i-project-name" class="am-u-sm-2 am-form-label">昵称</label>
							<div class="am-u-sm-10">
								<input type="text" id="i-project-name" name="project_name" placeholder="输入项目名称" data-validate-message="项目名称不能为空" required >
							</div>
						</div>
						<div class="am-form-group">
							<label for="i-project-name" class="am-u-sm-2 am-form-label">电子邮箱</label>
							<div class="am-u-sm-10">
								<input type="email" id="i-project-name" name="project_name" placeholder="输入项目名称" data-validate-message="项目名称不能为空" required >
							</div>
						</div>
						<div class="am-form-group">
							<label for="i-project-name" class="am-u-sm-2 am-form-label">性别</label>
							<div class="am-u-sm-10">
								      <label class="am-radio-inline">
										<input type="radio"  value="" name="docInlineRadio"> 每一分
									  </label>
									  <label class="am-radio-inline">
										<input type="radio" name="docInlineRadio"> 每一秒
									  </label>
									  <label class="am-radio-inline">
										<input type="radio" name="docInlineRadio"> 多好
									  </label>
							</div>
						</div>
						<div class="am-form-group">
							<label for="i-city-code" class="am-u-sm-2 am-form-label">所在城市</label>
							<div class="am-u-sm-2">
								<?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'required' => 'true')); ?>
							</div>
							<div class="am-u-sm-2 am-u-end">
								<?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'required' => 'true')); ?>
							</div>
						</div>
						<div class="am-form-group">
							<label for="address" class="am-u-sm-2 am-form-label">联系地址</label>
							<div class="am-u-sm-10">
								<input type="text" id="address" name="address" placeholder="输入详细地址" data-validate-message="项目地址不能为空" required>
							</div>
						</div>
						
						<button type="submit" class="am-btn am-btn-primary am-center">保 存</button>
					</form>
				</div>
			</div>
        </div>
		
</div>


<div id="loading-modal" class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="my-modal-loading">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">TITLE</div>
    <div class="am-modal-bd">
      <span class="am-icon-spinner am-icon-spin"></span>
    </div>
  </div>
</div>

<div id="alert-modal" class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">TITLE</div>
    <div class="am-modal-bd">
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn">确定</span>
    </div>
  </div>
</div>

@stop

@section('scripts')
<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
<script src="{{{asset('assets/vendor/jcrop/js/jquery.Jcrop.min.js')}}}"></script>
<script>
    


    var ModalManager = {
        $loadingModal : $('#loading-modal'),
        $alertModal : $('#alert-modal'),
        showLoadingModal : function(title){
            this.$loadingModal.modal('close');
            this.$loadingModal.find('.am-modal-hd').html(title);
            this.$loadingModal.modal({
                closeViaDimmer : false
            });
        },
        closeLoadingModal : function(){
            this.$loadingModal.modal('close');
        },
        showAlertModal : function(title, content){
            this.$alertModal.find('.am-modal-hd').html(title);
            this.$alertModal.find('.am-modal-bd').html(content);
            this.$alertModal.modal({
                closeViaDimmer : false
            });
        },
        closeAlertModal : function(){
            this.$alertModal.modal('close');
        }

    };


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

