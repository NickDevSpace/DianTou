@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
		<li><a href="{{{action('IController@getMessagePrivate')}}}">私信消息(<span style="color:red">{{{count($results)}}}</span>)</a></li>
		<li><a href="{{{action('IController@getMessageSystem')}}}">系统消息(1)</a></li>
		<li class="am-active"><a href="{{{action('IController@getMessageRead')}}}">已读消息</a></li>
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
				<th>消息内容</th>
				<th>发送时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
				@foreach($results as $r)
					<tr>
						<td>{{{$r->receiver->nickname}}}</td>
						<td>{{{$r->content}}}</td>
						<td>{{{$r->created_at}}}</td>
						<td>
							<a class="pm-reply-btn" data-pm-receiver="{{{$r->sender->id}}}" data-pm-receiver-name="{{{$r->receiver->nickname}}}" href="javascript:;">回复</a>
							<a class="pm-delete-btn" data-pm-id="{{{$r->id}}}" href="javascript:;">删除</a>&nbsp;
						</td>
					</tr>
				@endforeach
				
		</tbody>
	</table>
	<?php echo $results->links();?>
	@endif
	
</form>

<div class="am-modal am-modal-prompt" tabindex="-1" id="reply-modal">
  <div class="am-modal-dialog">
    <div class="am-modal-hd"><span></span><a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a></div>
    <div class="am-modal-bd">
	  <textarea class="am-modal-prompt-input" row="3"></textarea>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>发送</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>

@stop

@section('page_scripts')
<script>
    $(function(){
		App.init(['i.message']);
    });





</script>
@stop

