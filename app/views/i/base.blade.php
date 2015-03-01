@extends('layouts.master')
@section('page_title')
个人中心 | 点投
@stop
@section('head')
<style>
	.content-wrapper {
		padding: 35px 0;
	}
	
	.i-content{
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
					  <li @if($menu == 'account') class="am-active" @endif><a href="{{{action('IController@getAccountInfo')}}}"><span class="am-icon-user"></span> &nbsp;账号信息</a></li>
					  <li @if($menu == 'project') class="am-active" @endif><a href="{{{action('IController@getProjectMy')}}}"><span class="am-icon-star-o"></span> &nbsp;项目</a></li>
					  <li @if($menu == 'message') class="am-active" @endif><a href="{{{action('IController@getProjectMy')}}}"><span class="am-icon-envelope-o"></span> &nbsp;消息</a></li>
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
@stop
@section('vendor_scripts')
    <link rel="stylesheet" href="{{{asset('assets/vendor/jcrop/css/jquery.Jcrop.css')}}}"/>
	<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
	<script src="{{{asset('assets/vendor/jcrop/js/jquery.Jcrop.min.js')}}}"></script>
@stop