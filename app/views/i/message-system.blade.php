@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
		<li><a href="{{{action('IController@getMessagePrivate')}}}">私信消息</a></li>
		<li class="am-active"><a href="{{{action('IController@getMessageSystem')}}}">系统消息</a></li>
		<li><a href="{{{action('IController@getMessageRead')}}}">已读消息</a></li>
		<li style="float:right">消息</li>
	</ul>
@stop
@section('i-content')

<form id="i-passwd-form" action="{{{action('IController@postAccountPasswd')}}}" method="post" class="am-form am-form-horizontal data-am-validator">
	@if(count($results) == 0)
		<div class="am-vertical-align" style="height: 200px; text-align:center">
		  <div class="am-vertical-align-middle am-center">
			暂无消息
		  </div>
		</div>
	@else
	<table class="am-table am-table-striped am-table-hover">
		<thead>
			<tr>
				<th>发送者</th>
				<th>时间</th>
				<th>消息内容</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
				@foreach($results as $p)
					<tr>
						<td>System</td>
						<td>2015-01-01 15:22:12</td>
						<td>内容内容内容</td>
						<td><a href="#">修改</a> <a href="#">删除</a></td>
					</tr>
				@endforeach
				
		</tbody>
	</table>
	<?php echo $results->links();?>
	@endif
	
</form>

@stop

@section('page_scripts')
<script>
    $(function(){
		
		

    });





</script>
@stop

