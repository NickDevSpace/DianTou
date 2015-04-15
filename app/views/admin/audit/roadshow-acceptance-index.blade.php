@extends('layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">路演审核</strong> / <small>Roadshow Audit</small></div>
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
                    <input type="text" id="i-start-date" name="start_date" value="{{{$query_params['start_date']}}}" class="am-form-field" placeholder="开始日期" data-am-datepicker="{theme: 'success'}" readonly/>
                </div>
                <div class="am-form-group">
                    <input type="text" id="i-end-date" name="end_date" value="{{{$query_params['end_date']}}}" class="am-form-field" placeholder="结束日期" data-am-datepicker="{theme: 'success'}" readonly/>
                </div>
                <div class="am-input-group">
                <input type="text" class="am-form-field" name="keyword" value="{{{$query_params['keyword']}}}" placeholder="关键字">

              </div>
              <div class="am-input-group">
                <button class="am-btn am-btn-default" type="submit">搜索</button>
              </div>


    </div>

    <div class="am-g">
          <div class="am-u-sm-12">
            <form class="admin-list-form am-form">
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
                    <td>@if($r->accept_state == '1') 尚未验收 @elseif($r->accept_state == '2')验收暂存 @else已验收 @endif</td>
                    <td>{{{Config::get('app.DICT.PROJECT_STATE')[$r->project['state']]}}}</td>
                    <td>
                        <div class="am-btn-toolbar">
                          <div class="am-btn-group am-btn-group-xs">
                            <button class="admin-op-btn am-btn am-btn-default am-btn-xs am-text-danger" data-url="{{{action('AdminAuditController@getRoadshowDoAcceptance', array($r->id))}}}" data-target="_self">
                                <span class="am-icon-info-circle"></span>
                                @if($r->accept_state == '1')填写验收报告@elseif($r->accept_state == '2') 修改验收报告@else 查看验收报告@endif
                            </button>
                          </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @if(count($project_roadshows) == 0)
                <div class="admin-empty-content-note">暂无场次</div>
            @endif
            </form>

              <div class="am-cf">
              <button class="admin-op-btn am-btn am-btn-default am-btn-sm" data-url="{{{action('RoadshowManageController@getCreate')}}}" data-target="_self">
                  <span class="am-icon-plus"></span>
                  新增
              </button>
                共 {{{$project_roadshows->getTotal()}}} 条记录
              <div class="am-fr">
                <?php echo $project_roadshows->links();?>
              </div>
            </div>
      </div>

    </div>
</form>
@stop

@section('page_js')
<script>


</script>
@stop