@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
		<li class="am-active"><a href="{{{action('IController@getSubHistory')}}}">我的投资历史</a></li>
	</ul>
@stop
@section('i-content')

	@if(count($subs) == 0)
		<div class="am-vertical-align" style="height: 200px; text-align:center">
		  <div class="am-vertical-align-middle am-center">
			<h3><span class="am-icon-smile-o am-icon-md" style="margin:auto 5px;"></span>您尚未投资任何项目，这么多精彩的项目，马上<a href="#">去看看吧</a></h3>
		  </div>
		</div>
	@else
	<table class="am-table">
		<thead>
			<tr>
				<th>时间</th>
                <th>订单号</th>
				<th>项目名称</th>
				<th>投资金额</th>
				<th>投资股份</th>
				<th>订单状态</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
				@foreach($subs as $sub)
					<tr>
                        <td>{{{$sub->sub_time}}}</td>
                        <td>{{{$sub->sub_order}}}</td>
						<td><a href="{{{action('ProjectController@getShow', array($sub->project->id))}}}">{{{$sub->project->project_name}}}</a></td>
                        <td>{{{$sub->sub_amt}}}</td>
                        <td>{{{$sub->sub_share}}}%</td>
                        <td>{{{Config::get('app.DICT.SUB_STATE')[$sub->state]}}}</td>
                        <td>
                            @if($sub->state == '1')
                                <a href="#">去付款</a>
                            @endif
                        </td>
					</tr>
				@endforeach
				
		</tbody>
	</table>
	<?php echo $subs->links();?>
	@endif


@stop

@section('page_js')
<script>
    $(function(){
		
		

    });





</script>
@stop

