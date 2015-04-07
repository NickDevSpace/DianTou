@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户</strong> / <small>User</small></div>
</div>
<div class="am-g">
  <div class="am-u-md-6 am-cf">
    <div class="am-fl am-cf">
      <div class="am-btn-toolbar am-fl">
        <div class="am-btn-group am-btn-group-xs">

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
        <input type="text" class="am-form-field">
            <span class="am-input-group-btn">
              <button class="am-btn am-btn-default" type="button">搜索</button>
            </span>
      </div>
    </div>
  </div>
</div>


<div class="am-g">
      <div class="am-u-sm-12">
        <form class="am-form">
          <table class="am-table am-table-striped am-table-hover table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th>
                <th class="table-id">ID</th>
                <th class="table-title">账号</th>
                <th class="table-type">昵称</th>
                <th class="table-type">账号类型</th>
                <th class="table-author">账号状态</th>
                <th class="table-author">注册时间</th>
                <th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>
            @foreach($users as $u)
            <tr>
                <td><input type="checkbox" /></td>
                <td>{{{$u->id}}}</td>
                <td><a href="{{{action('AdminUserController@getDetail', array($u->id))}}}">{{{$u->account}}}</a></td>
                <td>{{{$u->nickname}}}</td>
                <td>@if($u->user_type == '1')个人@else 企业 @endif</td>
                <td>@if($u->active == 'Y')正常@else 禁用 @endif</td>
                <td>{{{$u->created_at}}}</td>
                <td>
                    <div class="am-btn-toolbar">
                      <div class="am-btn-group am-btn-group-xs">
                        @if($u->active == 'Y')
                            <button class="user-lock-btn am-btn am-btn-default am-btn-xs am-text-danger" data-user-id="{{{$u->id}}}"><span class="am-icon-lock"></span>禁用账号</button>
                        @else
                            <button class="user-unlock-btn am-btn am-btn-default am-btn-xs am-text-success" data-user-id="{{{$u->id}}}"><span class="am-icon-unlock-alt"></span>启用账号</button>
                        @endif
                      </div>
                    </div>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
        @if(count($users) == 0)
            <div class="admin-empty-content-note">没有记录</div>
        @endif

      <hr />
    </form>
    <div class="am-cf">
    共 {{{$total}}} 条记录
      <div class="am-fr">
        <?php echo $users->links();?>
      </div>
    </div>
  </div>

</div>
@stop

@section('page_js')
<script>
    $(function(){

        $('.user-lock-btn').on('click', function(){
            if(confirm('禁用后用户将无法登录网站！确认禁用该账号？')) {
                var id = $(this).attr('data-user-id');
                $.ajax({
                    url: BASE_URL + '/admin/user/lock-user',
                    method: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        if (data.errno == 'SUCCESS') {
                            alert('操作成功！');
                            window.location.reload();
                        } else {
                            alert('操作失败！');
                        }
                    }
                });
            }
        });

        $('.user-unlock-btn').on('click', function(){
            if(confirm('确认启用该账号？')) {
                var id = $(this).attr('data-user-id');
                $.ajax({
                    url: BASE_URL + '/admin/user/unlock-user',
                    method: 'post',
                    data: {id: id},
                    dataType: 'json',
                    success: function (data) {
                        if (data.errno == 'SUCCESS') {
                            alert('操作成功！');
                            window.location.reload();
                        } else {
                            alert('操作失败！');
                        }
                    }
                });
            }
        })
    });

</script>
@stop