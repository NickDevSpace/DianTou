@extends('layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">路演管理</strong> / <small>Roadshow Management</small></div>
</div>
<div class="am-g">

        <form action="{{{action('RoadshowManageController@getIndex')}}}" method="get" class="am-form am-form-inline" role="form">
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
                <th class="">标题</th>
                <th class="table-title">路演城市</th>
                <th class="">路演时间</th>
                <th class="">名额数</th>
                <th class="">举办标志</th>
                <th class="table-set">操作</th>
              </tr>
          </thead>
          <tbody>
            @foreach($results as $r)
            <tr>
                <td><input type="checkbox" /></td>
                <td>{{{$r->id}}}</td>
                <td><a href="#">{{{$r->title}}}</a></td>
                <td>{{{$r->province['province_name']}}} {{{$r->city['city_name']}}}</td>
                <td>{{{$r->scene_date}}}</td>
                <td>{{{$r->seats}}}</td>
                <td>@if($r->end_flag == 'Y') 已举办 @else 尚未举办 @endif</td>
                <td>
                    <div class="am-btn-toolbar">
                      <div class="am-btn-group am-btn-group-xs">
                        <button class="admin-op-btn am-btn am-btn-default am-btn-xs am-text-danger" data-url="{{{action('ProjectController@getShow', array($r->id))}}}" data-target="_blank">
                            <span class="am-icon-info-circle"></span>
                            详情
                        </button>
                      </div>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @if(count($results) == 0)
            <div class="admin-empty-content-note">暂无场次</div>
        @endif
        </form>

          <div class="am-cf">
          <button class="admin-op-btn am-btn am-btn-default am-btn-sm" data-url="{{{action('RoadshowManageController@getCreate')}}}" data-target="_self">
              <span class="am-icon-plus"></span>
              新增
          </button>
            共 {{{$results->count()}}} 条记录
          <div class="am-fr">
            <?php echo $results->links();?>
          </div>
        </div>
  </div>

</div>
@stop

@section('page_js')
<script>


</script>
@stop