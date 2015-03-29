@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">系统消息</strong> / <small>System Messge</small></div>
</div>
<div class="am-g">

        <div class="am-u-md-6 am-cf">
        <div class="am-fl am-cf">
          <div class="am-btn-toolbar am-fl">

          </div>
        </div>
        </div>
        <div class="am-u-md-3 am-cf">
        <div class="am-fr">
        </div>
        </div>

</div>

<div class="am-g">
      <hr/>
      <div class="am-u-sm-12">

            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">标题</div>
              <div class="am-u-sm-8 am-u-md-10">
                    {{{$msg->title}}}
              </div>
            </div>

            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">内容</div>
              <div class="am-u-sm-8 am-u-md-10">
                <pre>{{{$msg->content}}}</pre>
              </div>
            </div>

            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">发送对象</div>
              <div class="am-u-sm-8 am-u-md-10">
                @if($msg->send_type == '1')全部用户@elseif($msg->send_type == '2') 个人用户 @elseif($msg->send_type == '3') 企业用户 @endif
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">发送方式</div>
              <div class="am-u-sm-8 am-u-md-10">
                定时发送/立刻发送
              </div>
            </div>
            <div class="am-g am-margin-top">
              <div class="am-u-sm-4 am-u-md-2 am-text-right">发送时间</div>
              <div class="am-u-sm-8 am-u-md-10">
                {{{$msg->send_time}}}
              </div>
            </div>

            <div class="am-u-sm-3 am-u-sm-centered">
                <div class="am-margin">
                    <button  type="button" class="admin-back-btn am-btn am-btn-default">返回</button>
                </div>

            </div>
      </div>


</div>
@stop

@section('page_js')
<script>
    $(function(){
        $('#pass-btn').on('click', function(){
            if(confirm('确认该用户通过实名认证？')){
                $('input[name="audit_flag"]').val(1);
                $('#form').submit();
            }
        });

        $('#deny-btn').on('click', function(){
            if(confirm('确认该用户不通过实名认证？')){
                $('input[name="audit_flag"]').val(0);
                $('#form').submit();
            }
        });
    });

</script>
@stop