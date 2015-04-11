@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
		<li class="am-active"><a href="{{{action('IController@getProjectMy')}}}">我的项目</a></li>
		<li><a href="{{{action('IController@getProjectFollow')}}}">关注的项目</a></li>
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
			<h3><span class="am-icon-smile-o am-icon-md" style="margin:auto 5px;"></span>您尚未发起任何项目，马上<a href="#">创建一个</a></h3>
		  </div>
		</div>
	@else
	<table class="am-table">
		<thead>
			<tr>
				<th>项目名称</th>
				<th>发起时间</th>
				<th>融资总额</th>
				<th>当前进度</th>
				<th>当前状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
				@foreach($projects as $p)
					<tr>
						<td><a href="{{{action('ProjectController@getShow', array(1))}}}">{{{$p->project_name}}}</a></td>
						<td>{{{$p->created_at}}}</td>
						<td>{{{$p->raise_quota}}}</td>
						<td>{{{$p->raised_bal}}}({{{$p->raised_bal * 100 / $p->raise_quota}}}%)</td>
						<td>{{{Config::get('app.DICT.PROJECT_STATE')[$p->state]}}}</td>
						<td>
						    <a href="{{{action('ProjectController@getShow', array(1))}}}">项目详情</a>
						    @if($p->state == 'SAVE_DRAFT' || $p->state == 'AUDIT_FAILED')
						    <a href="{{{action('ProjectController@getEdit', array($p->id))}}}">修改</a>
						    @endif
						    @if($p->state == 'AUDIT_PASS')
						    <a href="{{{action('RoadshowSceneController@getSceneApply')}}}?project_id={{{$p->id}}}">申请路演</a>
						    @endif

						</td>
					</tr>
				@endforeach
				
		</tbody>
	</table>
	<?php echo $projects->links();?>
	@endif
	
	<!--
	<ul class="am-list">
	  <li>
		<div style="margin-top:5px; overflow:hidden">
			<div style="float:left;height:125px;width:125px;">
				<a href="#">
					<img class="am-img-thumbnail am-fl" src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg">
				</a>
			</div>
			<div>
				<h4><a href="#">北京烤鸭店</a></h4>
				<div>xxxxxxxx</div>
				
			</div>
		</div>
		</li>
	  <li><a href="#">我把最深沉的秘密放在那里。</a></li>
	  <li><a href="#">你不懂我，我不怪你。</a></li>
	  <li><a href="#">每个人都有一道伤口， 或深或浅，盖上布，以为不存在。</a></li>
	</ul>
	-->
</form>

@stop

@section('page_js')
<script>
    $(function(){
		
		

    });





</script>
@stop

