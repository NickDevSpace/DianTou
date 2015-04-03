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
<div class="am-g">

    <table class="am-table am-table-striped am-table-hover">
        <thead>
            <tr>
                <th style="width:5%"><input class="admin-select-all" type="checkbox"></th>
                <th style="width:7%"><span>全选</span></th>
                <th style="width:70%"><a href="#" class="admin-sm-delete">删除</a><a href="#" class="admin-sm-mark-read" style="margin-left:20px;">标记为已读</a></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
            <tr>
                <td><input class="megall" type="checkbox" name="item_id" value="{{{$msg->id}}}"></td>
                <td>@if($msg->is_read == 'Y')<span class="am-icon-envelope-o am-icon-sm" style="color:#aaa;"></span>@else<span class="am-icon-envelope-o am-icon-sm" style="color:#f79726"></span>@endif</td>
                <td><a href="{{{action('IController@getMessageSystemDetail', array($msg->id))}}}">{{{$msg->title}}}</a></td>
                <td>{{{$msg->send_time}}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


    @if(count($messages) == 0)
        <div class="am-vertical-align" style="height: 200px; text-align:center">
          <div class="am-vertical-align-middle am-center">
            <h3><span class="am-icon-smile-o am-icon-md" style="margin:auto 5px;"></span>暂无消息</h3>
          </div>
        </div>
    @endif
    <?php echo $messages->links();?>

</div>

@stop

@section('page_js')
<script>
    $(function(){
		
		App.init(['i.message']);

    });





</script>
@stop

