@extends('layouts.master')
@section('page_title')
个人中心 | 点投
@stop
@section('head')
<style>
	.content-wrapper {
		padding: 55px 0 35px;
		min-height:750px;
	}
	
	.i-content{
		margin-top:35px;
	}

    .i-nav .am-nav-pills > li > a {
         border-radius: 0;
         color: #585858;
         font-size: 16px;
         margin: 0 20px 0 0;
         padding: 0 15px 5px;
     }

     .i-nav .am-nav-pills > li > a:hover {
          background-color: #fff;
          border-bottom: 4px solid #008e59;
          color: #008e59;
      }

    .i-nav .am-nav-pills > li.am-active > a, .i-nav .am-nav-pills > li.am-active > a:hover {
         background-color: #fff;
         border-bottom: 4px solid #008e59;
         color: #008e59;
     }

     .i-nav .am-nav-pills{
         border-bottom: 1px solid #e7e9ec;
     }

    .am-table > tbody > tr > td{
        line-height:32px;
    }

</style>

@stop
@section('content')

<div class="content-wrapper">
        <div class="am-container">
            <div class="am-u-sm-3">

				    <div style="text-align:center; margin-top:15px">
				        <div class="i-avatar" style="position:relative">
                            <img src="{{{asset(Auth::user()->avatar)}}}" width="200"  class="am-img-thumbnail"/>
                            <a href="{{{action('IController@getAccountAvatar')}}}" class="i-change-avatar" style="position:absolute; bottom:5px; right:40px; display:none;"><span class="am-icon-edit" >更换头像</span></a>
                        </div>

					</div>
					<div style="text-align:center;">
					    <span>昵称：</span>{{{Auth::user()->nickname}}}

					</div>
					<div style="padding:0px 25px; margin-top:25px;">
                        <ul class="am-nav">
                          <li @if($menu == 'account') class="am-active" @endif><a href="{{{action('IController@getAccountInfo')}}}"><span class="am-icon-user"></span> &nbsp;账号信息</a></li>
                          <li @if($menu == 'project') class="am-active" @endif><a href="{{{action('IController@getProjectMy')}}}"><span class="am-icon-star-o"></span> &nbsp;项目</a></li>
                          <li @if($menu == 'sub') class="am-active" @endif><a href="{{{action('IController@getSubHistory')}}}"><span class="am-icon-envelope-o"></span> &nbsp;投资记录</a></li>
                          <li @if($menu == 'message') class="am-active" @endif><a href="{{{action('IController@getMessagePrivate')}}}"><span class="am-icon-envelope-o"></span> &nbsp;消息</a></li>

                        </ul>
                    </div>
			</div>
			<div class="am-u-sm-9">

				<div class="i-nav">
					@yield('i-nav')

				</div>

				<div class="i-content">
					@yield('i-content')
				</div>
			</div>
        </div>
		
</div>

<div id="avatar-cropper" class="am-modal am-modal-confirm" tabindex="-1" >
    <div class="am-modal-dialog">
        <div class="am-modal-hd">上传头像</div>
        <div class="am-modal-bd">
            <div id="crop-container"></div>
            <span id="crop-tip"></span>
        </div>
        <div class="am-modal-footer">
            <span class="am-modal-btn" data-am-modal-confirm>确定</span>
            <span class="am-modal-btn" data-am-modal-cancel>取消</span>
        </div>
    </div>
</div>
@stop
@section('vendor_js')
    <link rel="stylesheet" href="{{{asset('assets/vendor/jcrop/css/jquery.Jcrop.css')}}}"/>
	<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
	<script src="{{{asset('assets/vendor/jcrop/js/jquery.Jcrop.min.js')}}}"></script>

@stop