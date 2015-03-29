@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">系统消息</strong> / <small>System Message</small></div>
</div>


<div class="am-g">
      <hr/>
      <div class="am-u-sm-12">
            <form class="admin-input-form am-form" action="{{{action('AdminSystemMessageController@postSave')}}}" method="post">
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    消息标题
                    </div>
                    <div class="am-u-sm-8 am-u-md-4">
                    <input type="text" class="am-input-sm" name="title">
                    </div>
                    <div class="am-hide-sm-only am-u-md-6">*必填</div>
                </div>

                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    消息内容
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                    <textarea rows="10" name="content" placeholder="消息内容"></textarea>
                    </div>
                </div>
                <div class="am-g am-margin-top">
                    <div class="am-u-sm-4 am-u-md-2 am-text-right">
                    发送类型
                    </div>
                    <div class="am-u-sm-8 am-u-md-4 am-u-end col-end">
                        <div class="am-form-group">
                          <label class="am-radio-inline">
                            <input type="radio"  value="1" name="send_type" checked> 全部用户
                          </label>
                          <label class="am-radio-inline">
                            <input type="radio" value="2" name="send_type"> 个人用户
                          </label>
                          <label class="am-radio-inline">
                            <input type="radio" value="3" name="send_type"> 企业用户
                          </label>
                        </div>
                    </div>
                </div>





                <div class="am-u-sm-3 am-u-sm-centered">
                    <div class="am-margin">
                        <button id="admin-submit-btn" type="button" class="am-btn am-btn-primary">确认发送</button>
                        <button type="button" class="admin-back-btn am-btn am-btn-default">取消</button>
                    </div>

                </div>
            </form>
      </div>


</div>
@stop

@section('page_js')
<script>
    $(function(){
        $('#admin-submit-btn').on('click', function(){
            if(confirm('确认立刻发送系统消息？')){
                $('.admin-input-form').submit();
            }
        });
    });

</script>
@stop