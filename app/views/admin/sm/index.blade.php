@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">系统消息</strong> / <small>System Message</small></div>
</div>
<div class="am-g">
<form action="{{{action('AdminSystemMessageController@getIndex')}}}">
  <div class="am-u-md-6 am-cf">
    <div class="am-fl am-cf">
      <div class="am-btn-toolbar am-fl">
        <div class="am-btn-group am-btn-group-xs">
          <button type="button" class="admin-create-btn am-btn am-btn-default"><span class="am-icon-plus"></span> 人工发送</button>
        </div>

        <div class="am-form-group am-margin-left am-fl">
          <select>
            <option value="option1">所有类别</option>
            <option value="option2">IT业界</option>
            <option value="option3">数码产品</option>
            <option value="option3">笔记本电脑</option>
            <option value="option3">平板电脑</option>
            <option value="option3">只能手机</option>
            <option value="option3">超极本</option>
          </select>
        </div>
      </div>
    </div>
  </div>
  <div class="am-u-md-3 am-cf">
    <div class="am-fr">
      <div class="am-input-group am-input-group-sm">
        <input type="text" class="am-form-field" name="w" value="{{{$query['w']}}}"placeholder="消息关键字">
            <span class="am-input-group-btn">
              <button class="am-btn am-btn-default" type="submit">搜索</button>
            </span>
      </div>
    </div>
  </div>
  </form>
</div>


<div class="am-g">
    <div class="am-u-sm-12">
        <form class="admin-list-form am-form">
            <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
                <tr>
                    <th class="table-check"><input type="checkbox" /></th>
                    <th>ID</th>
                    <th>标题</th>
                    <th>发送对象</th>
                    <th>操作人</th>
                    <th>发送时间</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            @foreach($messages as $msg)
            <tr>
            <td><input type="checkbox" /></td>
            <td>{{{$msg->id}}}</td>
            <td><a href="{{{action('AdminSystemMessageController@getView', array($msg->id))}}}">{{{$msg->title}}}</a></td>
            <td>@if($msg->send_type == '1') 全部用户 @elseif($msg->send_type == '2') 个人用户 @elseif($msg->send_type == '3') 企业用户 @else 指定用户 @endif</td>
            <td>{{{$msg->sender['nickname']}}}</td>
            <td>{{{$msg->send_time}}}</td>
            <td>
                <div class="am-btn-toolbar">
                  <div class="am-btn-group am-btn-group-xs">
                    <button class="sm-delete-btn am-btn am-btn-default am-btn-xs am-text-secondary" data-id="{{{$msg->id}}}"><span class="am-icon-pencil-square-o"></span>撤销</button>
                  </div>
                </div>
            </td>

            </tr>
            @endforeach
            </tbody>
        </table>
        <div class="am-cf">
            <div class="am-fl">共 {{{$total}}} 条记录</div>

            <div class="am-fr">
                <div class="am-fr">
                  <?php echo $messages->links();?>
                </div>
            </div>
        </div>

    </form>
  </div>

</div>
@stop

@section('page_js')
<script>
    $(function(){
        $('.admin-create-btn').on('click',function(){
            window.location.href="{{{action('AdminSystemMessageController@getCreate')}}}";
            return false;
        });

        $('.sm-delete-btn').on('click', function(){
            alert($(this).attr('data-id'));
            $.ajax({
                url: "{{{action('AdminSystemMessageController@postDelete')}}}",
                type: "POST",
                data: {id: $(this).attr('data-id')},
                dataType: "json",
                success: function(data){
                    if(data.errno == 'SUCCESS'){
                        alert('撤销成功！');
                        window.location.reload();
                    }else{
                        alert('撤销失败！' + data.message);
                    }
                }
            });
            return false;
        });
    });

</script>
@stop