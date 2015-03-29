@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
		<li><a href="{{{action('IController@getProjectMy')}}}">我的项目</a></li>
		<li class="am-active"><a href="{{{action('IController@getProjectFollow')}}}">关注的项目</a></li>
		<li><a href="{{{action('IController@getProjectApp')}}}">预约的项目</a></li>
		<li><a href="{{{action('IController@getProjectSub')}}}">投资的项目</a></li>
		<li style="float:right">项目</li>
	</ul>
@stop
@section('i-content')

<form id="i-passwd-form" action="{{{action('IController@postAccountPasswd')}}}" method="post" class="am-form am-form-horizontal data-am-validator">
	@if(count($projects) == 0)
		<div class="am-vertical-align" style="height: 200px; text-align:center">
		  <div class="am-vertical-align-middle am-center">
			<h3><span class="am-icon-smile-o am-icon-md" style="margin:auto 5px;"></span>您尚未关注任何项目，马上<a href="#">浏览项目</a></h3>
		  </div>
		</div>
	@else
	<table class="am-table">
		<thead>
			<tr>
				<th>项目名称</th>
				<th>发起时间</th>
				<th>融资总额</th>
				<th>当前状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
				@foreach($projects as $p)
					<tr>
						<td>{{{$p->project_name}}}</td>
						<td>{{{$p->created_at}}}</td>
						<td>{{{$p->total_quota}}}</td>
						<td>{{{$p->state}}}</td>
						<td><a href="#">修改</a> <a href="#">删除</a></td>
					</tr>
				@endforeach
				
		</tbody>
	</table>
	<?php echo $projects->links();?>
	@endif
	
</form>

@stop

@section('page_js')
<script>
    $(function(){
		
		

    });

</script>
@stop

