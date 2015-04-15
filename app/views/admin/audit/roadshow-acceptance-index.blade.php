@extends('layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">路演验收</strong> / <small>Roadshow Acceptance</small></div>
</div>
<form action="{{{action('AdminAuditController@getRoadshowAcceptance')}}}" method="get" class="am-form am-form-inline" role="form">
    <div class="am-g">
              <div class="am-form-group">
                <?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'selected'=>$query_params['province_code'], 'required' => 'false')); ?>
              </div>
                <div class="am-form-group">
                <?php echo Form::amSelect(array('list'=>$city_select, 'value_field'=>'city_code','text_field'=>'city_name', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'selected'=>$query_params['city_code'], 'required' => 'false')); ?>
                </div>
                <div class="am-form-group">
                    <input type="text" id="i-start-date" name="start_date" value="{{{$query_params['start_date']}}}" class="am-form-field" placeholder="开始日期 yyyy-mm-dd" data-am-datepicker="{theme: 'success'}"/>
                </div>
                <div class="am-form-group">
                    <input type="text" id="i-end-date" name="end_date" value="{{{$query_params['end_date']}}}" class="am-form-field" placeholder="结束日期 yyyy-mm-dd" data-am-datepicker="{theme: 'success'}"/>
                </div>
                <div class="am-input-group">
                <input type="text" class="am-form-field" name="keyword" value="{{{$query_params['keyword']}}}" placeholder="项目名称">

              </div>
              <div class="am-input-group">
                <button class="am-btn am-btn-default" type="submit">查询</button>
              </div>
    </div>

    <div class="am-g">
          <div class="am-u-sm-12">
              <table class="am-table  table-main">
                <thead>
                  <tr>
                    <th class="table-check"><input type="checkbox" /></th>
                    <th class="table-id">ID</th>
                    <th class="">路演项目</th>
                    <th class="">路演时间</th>
                    <th class="table-title">路演城市</th>
                    <th class="">场次</th>
                    <th class="">场次状态</th>
                    <th class="">验收结果</th>
                    <th class="">项目当前状态</th>
                    <th class="table-set">操作</th>
                  </tr>
              </thead>
              <tbody>
                <?php $date = date('Y-m-d', time());?>
                @foreach($project_roadshows as $r)
                <tr>
                    <td><input type="checkbox" /></td>
                    <td>{{{$r->id}}}</td>
                    <td><a href="#">{{{$r->project['project_name']}}}</a></td>
                    <td>{{{$r->roadshowScene['scene_date']}}}</td>
                    <td>{{{$r->roadshowScene->province['province_name']}}} {{{$r->roadshowScene->city['city_name']}}}</td>
                    <td><a href="#">{{{$r->roadshowScene['title']}}}</a></td>
                    <td>@if($r->roadshowScene['scene_date'] > $date) 未开始 @elseif($r->roadshowScene['scene_date'] == $date) 进行中 @else 已结束 @endif</td>
                    <td>@if($r->accept_state == '1') <span class="am-text-danger">尚未验收</span> @elseif($r->accept_state == '2')<span class="am-text-secondary">验收暂存</span> @else<span class="am-text-success">已验收</span> @endif</td>
                    <td>{{{Config::get('app.DICT.PROJECT_STATE')[$r->project['state']]}}}</td>
                    <td>
                        <div class="am-btn-toolbar">
                            @if($r->accept_state == '1')
                                  <div class="am-btn-group am-btn-group-xs">
                                    <button class="admin-op-btn am-btn am-btn-default am-btn-xs am-text-success" data-url="{{{action('AdminAuditController@getRoadshowDoAcceptance', array($r->id))}}}" data-target="_self">
                                        <span class="am-icon-info-circle"></span>
                                        填写验收报告
                                    </button>
                                  </div>
                            @elseif($r->accept_state == '2')
                                <div class="am-btn-group am-btn-group-xs">
                                    <button class="admin-op-btn am-btn am-btn-default am-btn-xs am-text-success" data-url="{{{action('AdminAuditController@getRoadshowDoAcceptance', array($r->id))}}}" data-target="_self">
                                        <span class="am-icon-info-circle"></span>
                                        修改验收报告
                                    </button>
                                </div>
                            @else
                                <div class="am-btn-group am-btn-group-xs">
                                    <button class="admin-op-btn am-btn am-btn-default am-btn-xs am-text-success" data-url="{{{action('AdminAuditController@getRoadshowAcceptanceDetail', array($r->id))}}}" data-target="_self">
                                        <span class="am-icon-info-circle"></span>
                                        查看验收报告
                                    </button>
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @if(count($project_roadshows) == 0)
                <div class="admin-empty-content-note">暂无场次</div>
            @endif
                共 {{{$project_roadshows->getTotal()}}} 条记录
                  <div class="am-fr">
                    <?php echo $project_roadshows->links();?>
                  </div>
      </div>

    </div>
</form>
@stop

@section('page_js')
<script>


</script>
@stop