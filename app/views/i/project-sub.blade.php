@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
		<li><a href="{{{action('IController@getProjectMy')}}}">我的项目</a></li>
		<li><a href="{{{action('IController@getProjectFollow')}}}">关注的项目</a></li>
		<li class="am-active"><a href="{{{action('IController@getProjectSub')}}}">投资的项目</a></li>
		<li style="float:right">项目</li>
	</ul>
@stop
@section('i-content')

<form id="i-passwd-form" action="{{{action('IController@postAccountPasswd')}}}" method="post" class="am-form am-form-horizontal data-am-validator">
	@if(count($results) == 0)
		<div class="am-vertical-align" style="height: 200px; text-align:center">
		  <div class="am-vertical-align-middle am-center">
			<h3><span class="am-icon-smile-o am-icon-md" style="margin:auto 5px;"></span>您尚未投资任何项目，马上<a href="#">浏览项目</a></h3>
		  </div>
		</div>
	@else
	<table class="am-table">
		<thead>
			<tr>
				<th>项目名称</th>
				<th>融资总额</th>
				<th>当前进度</th>
                <th>剩余天数</th>
                <th>当前状态</th>
				<th>总投资金额</th>
				<th>总持有股份</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
				@foreach($results as $r)
					<tr>
						<td><a href="{{{action('ProjectController@getShow', array($r->id))}}}">{{{$r->project_name}}}</a></td>
						<td>{{{$r->raise_quota}}}</td>
						<td>{{{$r->raised_bal}}}({{{round($r->raised_bal * 100 / $r->raise_quota,0)}}}%)</td>
                        <td>{{{DateUtil::leftDays($r->raise_end_date)}}} 天</td>
                        <td>{{{Config::get('app.DICT.PROJECT_STATE')[$r->state]}}}</td>
						<td>{{{$r->total_sub_amt}}}</td>
						<td>{{{$r->total_sub_share}}}%</td>
                        <td><a href="{{{action('ProjectController@getShow', array($r->id))}}}" target="_blank">项目详情</a></td>

                    </tr>
				@endforeach
				
		</tbody>
	</table>
	<?php echo $results->links();?>
	@endif
	
</form>

@stop

@section('page_js')
<script>
    $(function(){
		
		

    });

</script>
@stop

