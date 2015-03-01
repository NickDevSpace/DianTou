(function($) {
  'use strict';

  $(function() {

		$('#login-btn').click(function(){
		  window.location.href = "/auth/login";
		});
		$('#register-btn').click(function(){
		  window.location.href = "/auth/register";
		});
	  
	  //把session flash自动隐藏掉
		setTimeout(function(){
			$('.am-alert').alert('close');
		}, 3000);
  });
})(jQuery);

(function(){
	var App = function(){
		//做一些初始化操作
	}
	
	//定义App对象中的各个方法，模块等
	App.prototype.ModalManager = {
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
	
	App.prototype.Util = {
		
	}
	
	window.App = new App();
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
	   App.ModalManager.showLoadingModal('正在上传，请稍后...');
	},
	cbUploadError: function( file, reason ) {
	   App.ModalManager.showAlertModal('提示', '上传失败！请重试！');
	},
	cbUploadSuccess: function( file, response ) {
		if(response.errno == 0){
			App.ModalManager.showAlertModal('提示', '上传成功！');
		}else{
			App.ModalManager.showAlertModal('提示', '上传失败！请重试！');
		}
	},
	cbUploadComplete: function(file){
		App.ModalManager.closeLoadingModal();
	},
	cbError: function(error){
		App.ModalManager.showAlertModal('错误', type);
	}

}

	
function dump_obj(myObject) {
    var s = "";
    for (var property in myObject) {
        s = s + "\n "+property +": " + myObject[property] ;
    }
    alert(s);
}