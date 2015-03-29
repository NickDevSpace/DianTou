@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">用户</strong> / <small></small></div>
</div>
<div class="am-g">
    <form>
        <div class="am-u-md-6 am-cf">
        <div class="am-fl am-cf">
          <div class="am-btn-toolbar am-fl">

          </div>
        </div>
        </div>
        <div class="am-u-md-3 am-cf">
        <div class="am-fr">
          <div class="am-input-group am-input-group-sm">
            <input type="text" class="am-form-field" name="account" value="{{{$query['account']}}}" placeholder="输入账号">
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
                <th class="table-check"><input type="checkbox" /></th><th class="table-id">ID</th><th class="table-title">账号</th><th class="table-type">账号类型</th><th class="table-author">申请时间</th><th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>
            @foreach($users as $u)
            <tr>
                <td><input type="checkbox" /></td>
                <td>{{{$u->id}}}</td>
                <td>{{{$u->account}}}</td>
                <td>@if($u->user_type == '1')个人@else 企业 @endif</td>
                <td>2015-02-20 15:20</td>
                <td>
                    <div class="am-btn-toolbar">
                      <div class="am-btn-group am-btn-group-xs">
                        <button class="user-certify-btn am-btn am-btn-default am-btn-xs am-text-secondary" data-user-id="{{{$u->id}}}"><span class="am-icon-pencil-square-o"></span>审核</button>
                      </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($users) == 0)
            <div class="admin-empty-content-note">暂无实名认证申请</div>
        @endif
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
        $('.user-certify-btn').on('click', function(){
            var id = $(this).attr('data-user-id');
            window.location.href="{{{action('AdminAuditController@getUserCertifyDetail')}}}/"+id ;
            return false;  //???
        });
    });

</script>
@stop