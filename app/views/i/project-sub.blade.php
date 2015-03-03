@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-tabs">
		<li><a href="{{{action('IController@getProjectMy')}}}">我的项目</a></li>
		<li><a href="{{{action('IController@getProjectFollow')}}}">关注的项目</a></li>
		<li><a href="{{{action('IController@getProjectPresub')}}}">预约的项目</a></li>
		<li class="am-active"><a href="{{{action('IController@getProjectSub')}}}">投资的项目</a></li>
		<li style="float:right">项目</li>
	</ul>
@stop
@section('i-content')

<form id="i-passwd-form" action="{{{action('IController@postAccountPasswd')}}}" method="post" class="am-form am-form-horizontal data-am-validator">
	@if(count($results) == 0)
		<div class="am-vertical-align" style="height: 200px; text-align:center">
		  <div class="am-vertical-align-middle am-center">
			您尚未投资任何项目，马上<a href="#">浏览项目</a>
		  </div>
		</div>
	@else
	<table class="am-table am-table-striped am-table-hover">
		<thead>
			<tr>
				<th>项目名称</th>
				<th>融资总额</th>
				<th>当前状态</th>
				<th>投资金额</th>
				<th>股份占比</th>
				<th>投资时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
				@foreach($results as $p)
					<tr>
						<td>{{{$p->project_name}}}</td>
						<td>{{{$p->total_amt}}}</td>
						<td>{{{$p->state}}}</td>
						<td>{{{$p->ack_amt}}}</td>
						<td>{{{$p->ack_share}}}</td>
						<td>{{{$p->ack_tm}}}</td>
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
