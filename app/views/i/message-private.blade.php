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
    <!-- 仿qq版
    <div class="am-u-sm-3">

        <div id="pm-chat-panel" class="am-panel am-panel-default">
          <div class="am-panel-hd">消息</div>
          <div class="am-panel-bd">
            <div class="pm-chat-view-wrapper" style="height:300px; overflow-y: auto">
                <div style="text-align: center">
                    <a class="pm-chat-more" href="javascript:;" style="display:none">更多</a>
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
                <div class="pm-chat-btn-wrapper am-g">
                    <button type="button" class="pm-chat-btn-send am-btn am-btn-success am-btn-sm am-fr am-disabled" style="margin-top:5px; margin-right:15px;">发送(ctrl+enter)</button>
                </div>
            </div>
          </div>
        </div>

    </div>-->

    <div class="am-u-sm-12">
    @if(count($msg_list) == 0)
        <div class="am-vertical-align" style="height: 200px; text-align:center">
          <div class="am-vertical-align-middle am-center">
            还没有用户给您发送私信哦
          </div>
        </div>
    @else
    <ul class="am-list">
        @foreach($msg_list as $msg)
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
        <!-- 表格版
        <div class="am-panel am-panel-default">
          <div class="am-panel-hd">用户消息</div>
          <div class="am-panel-bd">
                <input type="text" class="am-form-field am-round" placeholder="搜索用户消息"/>
          </div>
          <div id="pm-chat-no-user-list" style="display: none; text-align:center">还没有用户给您发送私信哦</div>



          <table class="am-table">
            <tr>
                <td><img src="https://avatars2.githubusercontent.com/u/6135346" width="32" class="am-img-thumbnail am-circle"/> 用户名<span class="am-badge am-badge-success">17</span></td>
                <td>消息内容消息内容消息内容。。。。。。</td>

                <td><a href="#">查看</a></td>
            </tr>
            <tr>
                <td><img src="https://avatars2.githubusercontent.com/u/6135346" width="32" class="am-img-thumbnail am-circle"/> 用户名<span class="am-badge am-badge-success">17</span></td>
                <td>消息内容消息内容消息内容。。。。。。</td>

                <td><a href="#">查看</a></td>
            </tr>
            <tr>
                <td><img src="https://avatars2.githubusercontent.com/u/6135346" width="32" class="am-img-thumbnail am-circle"/> 用户名<span class="am-badge am-badge-success">17</span></td>
                <td>消息内容消息内容消息内容。。。。。。</td>

                <td><a href="#">查看</a></td>
            </tr>
          </table>

          <ul id="pm-chat-user-list" class="am-list am-list-static">
            <li style="display:none"><img src="https://avatars2.githubusercontent.com/u/6135346" width="32" class="am-img-thumbnail am-circle"/><span class="am-badge am-badge-success">17</span>Tomcat</li>
          </ul>

        </div>
        -->
    </div>
</div>

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

@section('page_scripts')
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
                                lis += '<a href="#link-to-user-home">';
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

