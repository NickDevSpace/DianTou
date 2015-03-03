@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-tabs">
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
						<td>{{{$r->toUser->nickname}}}</td>
						<td>{{{$r->content}}}</td>
						<td>{{{$r->created_at}}}</td>
						<td>
							<a class="pm-reply-btn" data-pm-to-user="{{{$r->fromUser->id}}}" href="javascript:;">回复</a>
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
    <div class="am-modal-hd">私信给:{{{$r->toUser->nickname}}}<a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a></div>
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
		//标记为已读
		$('.pm-mark-read-btn').on('click', function(){
			$e = $(this);
			$tr = $e.parent().parent();
			markReadPM([$e.attr('data-pm-id')]);
		});
		
		//删除已读私信
		$('.pm-delete-btn').on('click', function(){
			$e = $(this);
			$tr = $e.parent().parent();
			deleteReadPM([$e.attr('data-pm-id')]);
		});
		
		//回复私信
		$('.pm-reply-btn').on('click', function(){
			$e = $(this);
			$tr = $e.parent().parent();
			
			$('.am-modal-prompt-input').val('');
			
			$('#reply-modal').modal({
			  relatedTarget: this,
			  onConfirm: function(e) {
				postPM($e.attr('data-pm-to-user'), e.data);
			  },
			  onCancel: function(e) {
				//
			  }
			});
			
				  
		});
		
		function markReadPM(pm_ids){
			$.ajax({
				url: "{{{action('PrivateMessageController@postMarkRead')}}}",
				method: 'post',
				data: {pm_ids: pm_ids},
				dataType: 'json',
				success:function(data){
					if(data.errno == 'SUCCESS'){
						$tr.fadeOut("slow",function(){
						   $tr.remove();
						});
					}
				}
			}); 
		}
		
		function postPM(to, content){
			$.ajax({
				url: "{{{action('PrivateMessageController@postSend')}}}",
				method: 'post',
				data: {to_user: to, content: content},
				dataType: 'json',
				success:function(data){
					if(data.errno == 'SUCCESS'){
						App.ModalManager.showAlertModal('发送成功！');
					}else{
						App.ModalManager.showAlertModal('发送失败！');
					}
				}
			});
		}
		
		function deleteReadPM(pm_ids){
			$.ajax({
				url: "{{{action('PrivateMessageController@postDeleteRead')}}}",
				method: 'post',
				data: {pm_ids: pm_ids},
				dataType: 'json',
				success:function(data){
					if(data.errno == 'SUCCESS'){
						$tr.fadeOut("slow",function(){
						   $tr.remove();
						});
					}
				}
			}); 
		}
		
		function deleteSentPM(pm_ids){
			$.ajax({
				url: "{{{action('PrivateMessageController@postDeleteSent')}}}",
				method: 'post',
				data: {pm_ids: pm_ids},
				dataType: 'json',
				success:function(data){
					if(data.errno == 'SUCCESS'){
						$tr.fadeOut("slow",function(){
						   $tr.remove();
						});
					}
				}
			}); 
		}
		

    });





</script>
@stop

