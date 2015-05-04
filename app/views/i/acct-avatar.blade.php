@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
    <ul class="am-nav am-nav-pills">
        <li><a href="{{{action('IController@getAccountInfo')}}}">基本信息</a></li>
        <li class="am-active"><a href="{{{action('IController@getAccountAvatar')}}}">头像修改</a></li>
        <li><a href="{{{action('IController@getAccountAuth')}}}">实名认证</a></li>
        <li><a href="{{{action('IController@getAccountPasswd')}}}">密码修改</a></li>
    </ul>
@stop
@section('i-content')


<form id="i-info-form" action="{{{action('IController@postAccountAvatar')}}}" method="post" class="am-form am-form-horizontal">
    <div class="am-g">
        <input type="hidden" name="path">
        <input type="hidden" name="w">
        <input type="hidden" name="h">
        <input type="hidden" name="x">
        <input type="hidden" name="y">

        <div class="am-u-sm-9" style="border-right:1px solid #e7e9ec">
            <p>请选择本地图片，并上传编辑自己的头像（支持jpg、jpeg、gif、png、bmp格式的图片）。</p>
            <div id="picker">选择图片</div>
            <div style="width:100%; height:300px; margin-bottom:20px;">
                <div id="crop-container" style="display:none; margin:auto auto;width:400px; height:300px; background-color:#e2e2e2;text-align: center;">

                </div>
            </div>

            <div class="am-u-sm-3 am-u-sm-centered">
                <button id="save-btn" type="button" class="am-btn am-btn-success am-u-centered" disabled="true">保存修改</button>
            </div>

        </div>

        <div class="am-u-sm-3">
            <h3>头像预览</h3>
            <div  style="overflow: hidden;width:100px;height:100px;margin-left:5px;">
                <img id="preview-100" src="{{{asset(Config::get('app.avatar_default'))}}}" >
            </div>
            <span>大头像 100*100</span>
            <div  style="overflow: hidden;width:55px;height:55px;margin-left:5px;margin-top:30px;">
                <img id="preview-55" src="{{{asset(Config::get('app.avatar_default'))}}}">
            </div>
            <span>小头像 55*55</span>
        </div>




    </div>


</form>

@stop

@section('page_js')
<script>
    $(function(){

        $('#save-btn').on('click', function(){
//            $.ajax({
//                url: BASE_URL + '/x/save-avatar',
//                type: 'POST',
//                data: {path: AvatarCrop.image_path, x:AvatarCrop.jcrop_api.tellSelect().x, y: AvatarCrop.jcrop_api.tellSelect().y, w: AvatarCrop.jcrop_api.tellSelect().w, h: AvatarCrop.jcrop_api.tellSelect().h },
//                async: false,
//                dataType: 'json',
//                success: function(data){
//                    if(data.errno == 'SUCCESS'){
//                        alert('SUCCESS');
//                    }else{
//                        alert('ERROR');
//                    }
//
//                }
//            });
            $('input[name="path"]').val(AvatarCrop.image_path);
            $('input[name="w"]').val(AvatarCrop.jcrop_api.tellSelect().w);
            $('input[name="h"]').val(AvatarCrop.jcrop_api.tellSelect().h);
            $('input[name="x"]').val(AvatarCrop.jcrop_api.tellSelect().x);
            $('input[name="y"]').val(AvatarCrop.jcrop_api.tellSelect().y);
            $('#i-info-form').submit();
        });

        var AvatarCrop = {
            $container: $('#crop-container'),
            $preview: $('#preview-100'),
            jcrop_api : null,
            image_path: '',
            init : function(image_path){
                var that = this;
                that.image_path = image_path;
                that.$container.html('<img id="main-image" src="' + BASE_URL + '/' + image_path + '">');
                $('#preview-100').attr('src', BASE_URL + '/' + image_path);
                $('#preview-55').attr('src', BASE_URL + '/' + image_path);
                that.$container.find('img').Jcrop({
                    bgColor:     'black',
                    bgOpacity:   .75,
                    setSelect:   [ 0, 0, 100, 100 ],
                    aspectRatio: 1/1,
                    onChange: that.showPreview,
                    onSelect: that.showPreview

                }, function(){
                    that.jcrop_api = this;
                });

            },
            showPreview: function(coords){


                if (parseInt(coords.w) > 0) {

                    var rx100 = 100 / coords.w;
                    var ry100 = 100 / coords.h;

                    $('#preview-100').css({
                        width: Math.round(rx100 * $('#main-image').width()) + 'px',
                        "min-width": Math.round(rx100 * $('#main-image').width()) + 'px',
                        height: Math.round(ry100 * $('#main-image').height()) + 'px',
                        marginLeft: '-' + Math.round(rx100 * coords.x) + 'px',
                        marginTop: '-' + Math.round(ry100 * coords.y) + 'px'
                    });

                    var rx55 = 55 / coords.w;
                    var ry55 = 55 / coords.h;
                    $('#preview-55').css({
                        width: Math.round(rx55 * $('#main-image').width()) + 'px',
                        "min-width": Math.round(rx55 * $('#main-image').width()) + 'px',
                        height: Math.round(ry55 * $('#main-image').height()) + 'px',
                        marginLeft: '-' + Math.round(rx55 * coords.x) + 'px',
                        marginTop: '-' + Math.round(ry55 * coords.y) + 'px'
                    });
                }

            }

        };

        var avatar_upload_args = {
            options: {
                server: BASE_URL + '/x/avatar-upload',
                pick: '#picker',
                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                },
                fileVal: 'avatar',
                formData: {time: 'xxx'}
            },
            onUploadSuccess: function(file, response){
                if(response.errno == 'SUCCESS') {
                    $('#crop-container').show();
                    AvatarCrop.init(response.path);
                    AvatarCrop.image_path = response.path;
                    $('#save-btn').removeAttr('disabled');
                }
            }
        }

        var coverUploader = new CommonUploader(avatar_upload_args);
    });
</script>
@stop

