@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
		<li><a href="{{{action('IController@getMessagePrivate')}}}">私信消息</a></li>
		<li class="am-active"><a href="{{{action('IController@getMessageSystem')}}}">系统消息</a></li>
	</ul>
@stop
@section('i-content')
<a href="javascript:history.go(-1);">&lt&lt返回</a>
<div class="am-g">


    <div class="am-cf">
        <div class="am-center" style="text-align: center">
            <h2>{{{$msg->title}}}</h2>
        </div>
        <div class="am-center" style="text-align: center">
            <span>{{{$msg->send_time}}}</span>
        </div>
    </div>

    <pre>{{{$msg->content}}}</pre>

</div>

@stop

@section('page_js')
<script>
    $(function(){
		
		

    });





</script>
@stop

