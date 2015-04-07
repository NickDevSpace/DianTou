@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目审核</strong> / <small>Project Audit</small></div>
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
            <input type="text" class="am-form-field" name="keyword" value="" placeholder="输入账号">
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
          <table class="am-table  table-main">
            <thead>
              <tr>
                <th class="table-check"><input type="checkbox" /></th>
                <th class="table-id">ID</th>
                <th class="table-title">项目名称</th>
                <th class="">发起人</th>
                <th class="table-author">提交时间</th>
                <th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>
            @foreach($audit_applies as $a)
            <tr>
                <td><input type="checkbox" /></td>
                <td>{{{$a->id}}}</td>
                <td><a href="{{{action('AdminProjectController@getDetail',array($a->obj_id))}}}">{{{$a->obj['project_name']}}}</a></td>
                <td><a href="{{{action('AdminUserController@getDetail',array($a->submitUser['id']))}}}">{{{$a->submitUser['account']}}}</a></td>
                <td>{{{$a->submit_time}}}</td>
                <td>
                    <div class="am-btn-toolbar">
                      <div class="am-btn-group am-btn-group-xs">
                        <a href="{{{action('AdminAuditController@getProjectAuditDetail', array($a->id))}}}">审核</a>
                      </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($audit_applies) == 0)
            <div class="admin-empty-content-note">暂无项目审核申请</div>
        @endif
        </form>

          <div class="am-cf">
      共 {{{$audit_applies->count()}}} 条记录
          <div class="am-fr">
            <?php echo $audit_applies->links();?>
          </div>
        </div>
  </div>

</div>
@stop

@section('page_js')
<script>
    $(function(){
        $('.project-audit-btn').on('click', function(){
            var id = $(this).attr('data-user-id');
            window.location.href="{{{action('AdminAuditController@getProjectAuditDetail')}}}/"+id ;
            return false;  //???
        });
    });

</script>
@stop