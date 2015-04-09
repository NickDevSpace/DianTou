@extends('layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">项目管理</strong> / <small>Project Management</small></div>
</div>
<div class="am-g">
    <form>
        <div class="am-u-md-6 am-cf">
        <div class="am-fl am-cf">
          <div class="am-btn-toolbar am-fl">
            <div class="am-input-group am-input-group-sm">
                <?php echo Form::amSelect(array('list'=>$state_select, 'value_field'=>'dict_key','text_field'=>'dict_value', 'header_text' => '请选择', 'id' => 'i-state', 'name'=>'state', 'selected'=>$query_params['state'], 'required' => 'false')); ?>

            </div>
          </div>
        </div>
        </div>
        <div class="am-u-md-3 am-cf">
        <div class="am-fr">
          <div class="am-input-group am-input-group-sm">
            <input type="text" class="am-form-field" name="keyword" value="{{{$query_params['keyword']}}}" placeholder="输入项目名称">
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
                <th class="">融资金额</th>
                <th class="">已融资</th>
                <th class="">融资期限</th>
                <th class="">发起人</th>
                <th class="">当前状态</th>
                <th class="table-author">发起时间</th>
                <th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>
            @foreach($projects as $a)
            <tr>
                <td><input type="checkbox" /></td>
                <td>{{{$a->id}}}</td>
                <td><a href="{{{action('AdminProjectController@getManage',array($a->id))}}}">{{{$a->project_name}}}</a></td>
                <td>{{{$a->raise_quota}}}</td>
                <td>{{{$a->raised_bal}}}</td>
                <td>{{{$a->raise_days}}}天</td>
                <td><a href="{{{action('AdminUserController@getDetail',array($a->id))}}}">{{{$a->user['account']}}}</a></td>
                <td>{{{Config::get('app.DICT.PROJECT_STATE')[$a->state]}}}</td>
                <td>{{{$a->created_at}}}</td>
                <td>
                    <div class="am-btn-toolbar">
                      <div class="am-btn-group am-btn-group-xs">
                        <button class="admin-op-btn am-btn am-btn-default am-btn-xs am-text-danger" data-url="{{{action('ProjectController@getShow', array($a->id))}}}" data-target="_blank">
                            <span class="am-icon-info-circle"></span>
                            项目详情
                        </button>
                        <button class="admin-op-btn am-btn am-btn-default am-btn-xs am-text-danger" data-url="{{{action('AdminProjectController@getManage', array($a->id))}}}" data-target="_self">
                            <span class="am-icon-info-circle"></span>
                            管理
                        </button>
                      </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($projects) == 0)
            <div class="admin-empty-content-note">暂无项目</div>
        @endif
        </form>

          <div class="am-cf">
      共 {{{$projects->count()}}} 条记录
          <div class="am-fr">
            <?php echo $projects->links();?>
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