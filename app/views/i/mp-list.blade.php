@extends('i.base')
@section('page_title')
个人中心 | 点投
@stop
@section('i-nav')
	<ul class="am-nav am-nav-pills">
		<li class="am-active"><a href="{{{action('IController@getMessagePrivate')}}}">私信消息</a></li>
		<li><a href="{{{action('IController@getMessageSystem')}}}">系统消息</a></li>
	</ul>
@stop
@section('i-content')
<div class="am-g">
    <table class="am-table am-table-striped am-table-hover">
        <thead>
            <tr>
                <th style="width:5%"><input class="megall" type="checkbox" name="megall" value=""></th>
                <th style="width:7%"><span>全选</span></th>
                <th style="width:70%"><span>删除</span><span style="margin-left:20px;">标记为已读</span></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
            <tr>
                <td><input class="megall" type="checkbox" name="megall" value=""></td>
                <td><img src="http://s0.meituan.net/www/img/user-avatar.v9bfc4a71.png" width="30" class="am-img-thumbnail am-circle"/></td>
                <td>我给你发了{{{$msg->unread_cnt}}}条新消息，点击<a data-sender-id="{{{$msg->sender_id}}}" data-sender-name="{{{$msg->sender_name}}}" class="show-chat-window-btn" href="#">查看</a></td>
                <td>{{{$msg->last_time}}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(count($messages) == 0)
        <div class="am-vertical-align" style="height: 200px; text-align:center">
          <div class="am-vertical-align-middle am-center">
            <h3><span class="am-icon-smile-o am-icon-md" style="margin:auto 5px;"></span>还没有用户给您发送私信哦</h3>
          </div>
        </div>
    @endif
    <?php //echo $messages->links(); ?>
    <!--
    <div class="am-u-sm-12">
    @if(count($messages) == 0)
        <div class="am-vertical-align" style="height: 200px; text-align:center">
          <div class="am-vertical-align-middle am-center">
            还没有用户给您发送私信哦
          </div>
        </div>
    @else
    <ul class="am-list">
        @foreach($messages as $msg)
            <li>
                <div class="am-cf" style="line-height:54px;">
                    <div class="am-fl">
                        <img src="https://avatars2.githubusercontent.com/u/6135346" width="32" class="am-img-thumbnail am-circle"/>
                        <span style="display:inline-block;margin-left:8px; width:100px;">{{{$msg->sender_name}}}</span>
                        @if($msg->unread_cnt > 0)
                            <span class="am-badge am-badge-success am-round">{{{$msg->unread_cnt}}}</span>
                        @endif
                    </div>

                    <div class="am-fl" style="margin-left:50px;">我给你发了{{{$msg->unread_cnt}}}条新消息，点击<a data-sender-id="{{{$msg->sender_id}}}" data-sender-name="{{{$msg->sender_name}}}" class="show-chat-window-btn" href="#">查看</a></div>

                    <span class="am-fr">{{{$msg->last_time}}}</span>
                </div>
            </li>
        @endforeach
    </ul>
    @endif

    </div>
    -->
</div>


<div class="pm-chat-window am-modal am-modal-no-btn" tabindex="-1" >
  <div class="am-modal-dialog">
    <div class="am-modal-hd"><span></span>
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd" >
            <div class="pm-chat-view-wrapper" style="height:300px; border:solid 1px #ddd; overflow-y: auto; background-color:#fff; text-align:left">
                <div style="text-align: center">
                    <a class="pm-chat-more" href="javascript:;" style="display:none">更多&#8593;</a>
                    <span class="pm-chat-end" style="display:none">到顶儿了~</span>
                </div>
                <ul class="am-comments-list am-comments-list-flip">
                    <li class="am-comment" style="display:none">
                        <a href="#link-to-user-home">
                        <img class="am-comment-avatar" width="48" height="48" alt="" src="https://avatars2.githubusercontent.com/u/6135346">
                        </a>
                        <div class="am-comment-main">
                        <div class="am-comment-bd">
                        <p>
                        <a href="#lin-to-user">@某人</a>
                        撸主保重，我就阿了快速的将发了记录卡了看见了卡斯的ljlkknow， 我就了考试的了开发萨拉克的菲利克斯就 ！
                        </p>
                        </div>
                        </div>
                    </li>

                </ul>
            </div>
            <hr/>
            <div class="pm-chat-input-wrapper">
                <textarea class="pm-chat-input" style="width:100%; height:100px;"></textarea>
                <div class="pm-chat-btn-wrapper am-g" >
                    <button type="button" class="pm-chat-btn-send am-btn am-btn-success am-btn-sm am-fr am-disabled" style="margin-top:12px; margin-bottom:12px;">发送(ctrl+enter)</button>
                </div>
            </div>
    </div>
  </div>
</div>
@stop

@section('page_js')
<script>
    $(function(){

        var page = 1;
        var opp_user;
        var opp_name;
        var min_msg_id = null;
        var max_msg_id = null;
        var lock = 0;


        function showChatHistory(before_after){


            $('.pm-chat-window .am-modal-hd span').html(opp_name + "的消息");

            $.ajax({
                    url: BASE_URL + '/pm/pm-history',
                    method: 'post',
                    data: {opp_user_id: opp_user, min_msg_id: min_msg_id, max_msg_id: max_msg_id, before_after:before_after, fetch_size: 15},
                    dataType: 'json',
                    success: function(data){
                        if(data.errno == 0){
                            var lis = "";
                            if(data.result.length == 0){
                                if(before_after == 'before'){
                                    $('.pm-chat-more').hide();
                                    $('.pm-chat-end').show();
                                }

                                return;
                            }
                            var curr_min_id = data.result[0].id;
                            var curr_max_id = data.result[data.result.length - 1].id;
                            if(min_msg_id == null || curr_min_id < min_msg_id){
                                min_msg_id = curr_min_id;
                            }
                            if(max_msg_id == null || curr_max_id > max_msg_id){
                                max_msg_id = curr_max_id;
                            }

                            for(var i in data.result){
                                var row = data.result[i];
                                if(row.sender == opp_user){
                                    lis += '<li class="am-comment">';
                                }else{
                                    lis += '<li class="am-comment am-comment-flip">';
                                }
                                lis += '<a href="#link-to-user-mgr-home">';
                                lis += '<img class="am-comment-avatar" width="48" height="48" alt="" src="https://avatars2.githubusercontent.com/u/6135346">';
                                lis += '</a>';
                                lis += '<div class="am-comment-main">';
                                lis += '<div class="am-comment-bd">';
                                lis += '<p>';
                                lis += row.content;
                                lis += '</p>';
                                lis += '</div>';
                                lis += '</div>';
                                lis += '</li>';
                            }
                            if(before_after == 'init'){
                                $('.pm-chat-view-wrapper ul').html(lis);
                                $(".pm-chat-view-wrapper").scrollTop($(".pm-chat-view-wrapper")[0].scrollHeight);
                                $('.pm-chat-more').show();
                                $('.pm-chat-end').hide();
                            }else if(before_after == 'before'){
                                $('.pm-chat-view-wrapper ul').prepend(lis);
                            }else{
                                $('.pm-chat-view-wrapper ul').append(lis);
                                $(".pm-chat-view-wrapper").scrollTop($(".pm-chat-view-wrapper")[0].scrollHeight);
                            }
                            //$('.pm-chat-view-wrapper ul').html(lis);

                        }

                    }
            });
        }

        function sendMsg(){
            var content = $('.pm-chat-input').val();
            $('.pm-chat-input').val('');
            App.PM.send(opp_user, content, function(data){
                if(data.errno == 0){
                    showChatHistory('after');
                }
            });
        }


        $('.show-chat-window-btn').on('click',function(){
            var sender = $(this).attr('data-sender-id');
            var sender_name = $(this).attr('data-sender-name');
            opp_user = sender;
            opp_name = sender_name;
            $('.pm-chat-btn-send').removeClass('am-disabled');

            $('.pm-chat-window').modal({
                width:500,
                height:540
            });
            showChatHistory('init');
        });

        $('.pm-chat-input').on('keyup',function (event){
             if (event.ctrlKey && event.keyCode == 13)  {
                sendMsg();
            }
        });
        $('.pm-chat-btn-send').on('click', function(){
            sendMsg();
        });

        $('.pm-chat-more').on('click', function(){
            showChatHistory('before');
        });



        setInterval(function(){
            if(opp_user){
                showChatHistory('after');
            }
        }, 5000);

		App.init(['i.message']);


    });





</script>
@stop

