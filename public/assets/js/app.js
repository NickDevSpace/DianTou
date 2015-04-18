(function($) {
  'use strict';

  $(function() {
      $('#login-btn').click(function(){
          window.location.href = BASE_URL + "/auth/login";
      });
      $('#register-btn').click(function(){
          window.location.href = BASE_URL + "/auth/reg";
      });

	  //把session flash自动隐藏掉
		setTimeout(function(){
			$('.am-alert').alert('close');
		}, 3000);



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


  });
})(jQuery);

(function(){
	var App = {};
	
	var _App = App;  //这一步是为了在App对象内部定义的函数中可以使用App对象
	
	//所有页面模块的初始化脚本都统一放这儿
	App.inits = {
		index: function(){


            $('#wx-gz').on('click', function(){
                $(this).hide();
            });
		},
		project: {
			create: function(){
				var editor;
				KindEditor.ready(function(K) {
					editor = K.create('textarea[name="detail"]', {
						resizeType : 1,
						allowPreviewEmoticons : true,
						allowImageUpload : true,
                        uploadJson: BASE_URL + '/x/project-show-upload',
						items : [
                            'undo', 'redo','|','fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
							'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
							'insertunorderedlist', '|', 'emoticons', 'image','multiimage','table', 'hr', 'link']
					});
				});
				
				var coverCroper = {
						$container: $('#crop-container'),
						jcrop_api : null,
						image_path: '',
						init : function(image_path){
							var that = this;
							that.image_path = image_path;
							that.$container.html('<img width="600" src="' + BASE_URL + '/' + image_path + '">');
							that.$container.find('img').Jcrop({
								boxWidth:600,
								bgColor:     'black',
								bgOpacity:   .4,
								setSelect:   [ 0, 0, 460, 350 ],
								aspectRatio: 460 / 350,
								maxSize: [460, 350]

							}, function(){
								that.jcrop_api = this;
							});

						}
				};
				
				//绑定行业选择器事件
				$('#i-industry-1').on('change', function(){
					var val = $(this).find("option:selected").val();
					if(val == ''){
						$("#i-industry-2").empty();
						$("<option></option>").val('').text('请选择').appendTo($("#i-industry-2"));
						return;
					}

					$.getJSON(BASE_URL + '/x/get-industry-list', {parent : val}, function(data){
						$("#i-industry-2").empty();
						data.unshift({industry_code : '', industry_name : '请选择'});
						$.each(data, function(i, item) {
							$("<option></option>")
								.val(item["industry_code"])
								.text(item["industry_name"])
								.appendTo($("#i-industry-2"));
						});
					})

				});

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

				//自动计算融资需求
				$('input[name="raise_quota"], input[name="assign_copies"]').on('keyup', function(){
				
					var raise_quota = $('input[name="raise_quota"]').val();
					var assign_copies = $('input[name="assign_copies"]').val();
					
					var quota_of_copy = (raise_quota / assign_copies).toFixed(2);
					
					$('input[name="quota_of_copy"]').val(quota_of_copy);
				});


				//coverUploader.init();
				//resUploader.init();

				var cover_args = {
					options: {
						server: BASE_URL + '/x/project-cover-upload',
						pick: '#cover-picker',
						// 只允许选择图片文件。
						accept: {
							title: 'Images',
							extensions: 'gif,jpg,jpeg,bmp,png',
							mimeTypes: 'image/*'
						},
						fileVal: 'project_cover',
						formData: {time: 'xxx'}
					},
					onUploadSuccess: function(file, response){
						if(response.errno == 0){
							coverCroper.init(response.path);
							$('#cover-editor').modal({
                                width:600,
								onConfirm: function(options) {
									$.ajax({
										url: BASE_URL + '/x/project-cover-crop',
										type: 'POST',
										data: {path: coverCroper.image_path, cons_with: 600, x:coverCroper.jcrop_api.tellSelect().x, y: coverCroper.jcrop_api.tellSelect().y, w: coverCroper.jcrop_api.tellSelect().w, h: coverCroper.jcrop_api.tellSelect().h },
										async: false,
										dataType: 'json',
										success: function(data){
											if(data.errno == 0){
												var imgURL = BASE_URL + '/' + data.path;
												$('#project-cover-preview').html('');
												$('#project-cover-preview').append('<img width="230" height="175" src="' + imgURL + '" alt="封面预览图" class="am-img-thumbnail"/>');
												$('input[name="project_cover"]').val(data.path);
											}else{
												$('#project-cover-preview').html('图片保存失败，请重试');
											}

										}
									});

								},
								onCancel: function() {
								   coverCroper.jcrop_api.destroy();
								},
								closeViaDimmer: false
							});

						}else{
							_App.Common.ModalManager.showAlertModal('提示', '上传失败！请重试！');
						}
					}
				}

				var coverUploader = new CommonUploader(cover_args);

				var plan_args = {
					options: {
						server: BASE_URL + '/x/project-resource-upload',
						pick: '#plan-picker',
						accept: {
							title: '文档',
							extensions: 'doc,docx,ppt,pptx,pdf,txt',
							mimeTypes: 'application/msword, application/pdf, application/vnd.ms-powerpoint, plain/text'
						},
						fileVal: 'res_file',
						formData:{res_type:'docs'}
					},
					onUploadSuccess: function( file, response ){
						var me = this;
						if(response.errno == 0){
							_App.Common.ModalManager.showAlertModal('提示', '上传成功！');
                            $('#plan-view').html(file.name);
						}else{
							_App.Common.ModalManager.showAlertModal('提示', '上传失败！请重试！');
						}
					}
				};

				var planUploader = new CommonUploader(plan_args);



				var res_args = {
							options: {
								server: BASE_URL + '/x/project-resource-upload',
								pick: '.resource-picker',
								accept: {
									title: 'Images',
									extensions: 'gif,jpg,jpeg,bmp,png',
									mimeTypes: 'image/*'
								},
								fileVal: 'res_file'
							},
							onCreate: function(){
								var me = this;
								$('.resource-picker').on('click', function(){
									var curResName = $(this).attr('data-res-name');
									me.curResName = curResName;
									me.options.formData = {res_name: curResName};
								});
							},
							onUploadSuccess: function( file, response ){
								var me = this;
								if(response.errno == 0){
									$('input[name="' + me.curResName + '"]').val(response.path);
									var imgURL = BASE_URL + '/' + response.path;
									$('#rp_'+ me.curResName).html('<img width="230" height="175" src="' + imgURL + '" alt="预览图" class="am-img-thumbnail"/>');
								}else{
									_App.Common.ModalManager.showAlertModal('提示', '上传失败！请重试！');
								}
							}
						};

				var resUploader = new CommonUploader(res_args);
				
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
						
						
					}
				});
			}
		},
		i: {
			acct: {
				info: function(){
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
					//给个人信息表单添加验证
					//...
				},
				auth: function(){
                    //验证码
                    $('.v-code-btn').click(function () {
                        var $btn = $(this);
                        var mobile = $("input[name='account']").val();
                        App.Common.SMSVerification.sendVCode(mobile, $btn);
                    });

					//增加上传按钮的绑定
					var res_args = {
						options: {
							server: BASE_URL + '/x/project-resource-upload',
							pick: '.resource-picker',
							accept: {
								title: 'Images',
								extensions: 'gif,jpg,jpeg,bmp,png',
								mimeTypes: 'image/*'
							},
							fileVal: 'res_file'
						},
						onCreate: function(){
							var me = this;
							$('.resource-picker').on('click', function(){
								var curResName = $(this).attr('data-res-name');
								me.curResName = curResName;
								me.options.formData = {res_name: curResName};
							});
						},
						onUploadSuccess: function( file, response ){
							var me = this;
							if(response.errno == 0){
								$('input[name="' + me.curResName + '"]').val(response.path);
								var imgURL = BASE_URL + '/' + response.path;
								$('#rp_'+ me.curResName).html('<img width="230" height="175" src="' + imgURL + '" alt="预览图" class="am-img-thumbnail"/>');
							}else{
								_App.Common.ModalManager.showAlertModal('提示', '上传失败！请重试！');
							}
						}
					};

					var resUploader = new CommonUploader(res_args);
				},
				passwd: function(){
					//noop
				}
				
			},
			project: function(){
			
			},
			message: function(){

                $('.admin-select-all').on('click', function(){
                    $("input[type='checkbox'][name='item_id']").prop('checked', $(this).prop('checked'));
                });

                $('.admin-pm-delete').on('click', function(){
                    var $items = $("input[type='checkbox'][name='item_id']:checked");

                    if($items.length <= 0){
                        alert('请选择要删除的会话');
                    }else{
                        if(confirm('确认删除所选会话？')) {
                            var sender_ids = [];
                            $items.each(function () {
                                sender_ids.push($(this).val());
                            })
                            $.ajax({
                                url: BASE_URL + '/pm/delete-sessions',
                                method: 'post',
                                data: {sender_id: sender_ids},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.errno == 'SUCCESS') {
                                        alert('删除成功！')
                                        window.location.reload();
                                    } else {
                                        alert('删除失败！');
                                    }
                                }
                            });
                        }
                    }
                });

                $('.admin-pm-mark-read').on('click', function(){
                    var $items = $("input[type='checkbox'][name='item_id']:checked");

                    if($items.length <= 0){
                        alert('请选择要标记为已读的会话');
                    }else{
                        if(confirm('确认将所选会话标记为已读？')) {
                            var sender_ids = [];
                            $items.each(function () {
                                sender_ids.push($(this).val());
                            })
                            $.ajax({
                                url: BASE_URL + '/pm/mark-read-sessions',
                                method: 'post',
                                data: {sender_id: sender_ids},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.errno == 'SUCCESS') {
                                        alert('操作成功！');
                                        window.location.reload();
                                    } else {
                                        alert('操作失败！');
                                    }
                                }
                            });
                        }
                    }
                });

                $('.admin-sm-delete').on('click', function(){
                    var $items = $("input[type='checkbox'][name='item_id']:checked");

                    if($items.length <= 0){
                        alert('请选择要删除的消息');
                    }else{
                        if(confirm('确认删除所选消息？')) {
                            var delivery_ids = [];
                            $items.each(function () {
                                delivery_ids.push($(this).val());
                            })
                            $.ajax({
                                url: BASE_URL + '/sm/delete-deliveries',
                                method: 'post',
                                data: {delivery_ids: delivery_ids},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.errno == 'SUCCESS') {
                                        alert('删除成功！')
                                        window.location.reload();
                                    } else {
                                        alert('删除失败！');
                                    }
                                }
                            });
                        }
                    }
                });

                $('.admin-sm-mark-read').on('click', function(){
                    var $items = $("input[type='checkbox'][name='item_id']:checked");

                    if($items.length <= 0){
                        alert('请选择要标记为已读的会话');
                    }else{
                        if(confirm('确认将所选会话标记为已读？')) {
                            var delivery_ids = [];
                            $items.each(function () {
                                delivery_ids.push($(this).val());
                            })
                            $.ajax({
                                url: BASE_URL + '/sm/mark-read-deliveries',
                                method: 'post',
                                data: {delivery_ids: delivery_ids},
                                dataType: 'json',
                                success: function (data) {
                                    if (data.errno == 'SUCCESS') {
                                        alert('操作成功！');
                                        window.location.reload();
                                    } else {
                                        alert('操作失败！');
                                    }
                                }
                            });
                        }
                    }
                });
			}
		}
	}
	
	//用户页面调用自己的初始化脚本 App.init([module1, module2]);
	App.init = function(modules){
		var me = this;
		for(var i in modules){
			var current_module = modules[i];
			var code = 'me.inits.' + current_module + '();';
			eval(code);
		}
	};
	
	//App的各种模块
	App.PM = {
		send: function(receiver, content, cb){
			
			$.ajax({
				url: BASE_URL + '/pm/send' ,
				method: 'post',
				data: {receiver: receiver, content: content},
				dataType: 'json',
				success: cb
			});
		},
		markRead: function(pm_ids, cb){
			
			$.ajax({
				url: BASE_URL + '/pm/mark-read',
				method: 'post',
				data: {pm_ids: pm_ids},
				dataType: 'json',
				success:cb
			}); 
		},
		deleteRead: function(pm_ids, cb){
			
			$.ajax({
				url: BASE_URL + '/pm/delete-read',
				method: 'post',
				data: {pm_ids: pm_ids},
				dataType: 'json',
				success:cb
			}); 
		},
		deleteSent: function(pm_ids, cb){
			
			$.ajax({
				url: BASE_URL + '/pm/delete-sent',
				method: 'post',
				data: {pm_ids: pm_ids},
				dataType: 'json',
				success: cb
			}); 
		}
		
	},
	
	App.Common = {
		ModalManager : {
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
		},
        SMSVerification : {
            sendVCode : function(mobile, $btn){
                $.ajax({
                    url: BASE_URL + '/x/sms-verification-code' ,
                    method: 'get',
                    data: {mobile: mobile},
                    dataType: 'json',
                    success: function(data){
                        if(data.errno == '0'){
                            var left_time = data.exp_time;
                            alert('Duang! 就当我是短信：' + data.v_code);
                            $btn.addClass('am-disabled');
                            var int = setInterval(function(){
                                left_time --;
                                $btn.html("获取验证码(" + left_time +")");
                                if(left_time == 0){
                                    clearInterval(int);
                                    $btn.html("获取验证码");
                                    $btn.removeClass('am-disabled');
                                }
                            },1000);
                        }else{
                            alert('请求失败，短信验证码发送技能正在冷却中：' + data.message);
                        }
                    }
                });
            }
        }
	};
	
	App.Util = {
		
	};
	
	window.App = App;
})();






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
	   App.Common.ModalManager.showLoadingModal('正在上传，请稍后...');
	},
	cbUploadError: function( file, reason ) {
	   App.Common.ModalManager.showAlertModal('提示', '上传失败！请重试！');
	},
	cbUploadSuccess: function( file, response ) {
		if(response.errno == 0){
			App.Common.ModalManager.showAlertModal('提示', '上传成功！');
		}else{
			App.Common.ModalManager.showAlertModal('提示', '上传失败！请重试！');
		}
	},
	cbUploadComplete: function(file){
		App.Common.ModalManager.closeLoadingModal();
	},
	cbError: function(error){
		App.Common.ModalManager.showAlertModal('错误', type);
	}

}

	
function dump_obj(myObject) {
    var s = "";
    for (var property in myObject) {
        s = s + "\n "+property +": " + myObject[property] ;
    }
    alert(s);
}