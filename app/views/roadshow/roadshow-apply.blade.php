@extends('...layouts.master')

@section('page_title')
申请路演 - 点投
@stop
@section('head')
<style>
    .content-wrapper {
		padding: 35px 0 200px 0;
	}
</style>
@stop

@section('content')
<div class="content-wrapper">
    <div class="am-container">

        <strong class="am-text-primary am-text-lg">路演申请</strong>
        <hr>
        <pre>
        1. 项目团队人数≥2人
        2、项目成功运作1年以上
        3. 项目必须有内容可供演示
        4. 项目必须有完整的商业计划及其历史财务资料
        5. 项目必须拥有独特商业模式和商业价值的创业型项目
        6. 项目必须有明确的融资需求，融资标的范围</pre>
        <!--<h3>项目信息</h3>
        <hr/>
        <div class="am-u-sm-10 am-u-lg-8 am-u-md-8 am-u-sm-centered">
            <div class="am-u-md-10 am-cf">
                <div class="am-fl">
                  <label>项目名称</label> aaaaaaa
                </div>
                <div class="am-fr">
                  <label>项目名称</label>aaaaaaa
                </div>
            </div>
            <div style="clear: both"> </div>
        </div>-->



            <form id="form" action="{{{action('RoadshowSceneController@postSceneApply')}}}" method="post" class="am-form am-form-horizontal" style="margin-top:50px;">
                <input type="hidden" name="project_id" value="{{{$project->id}}}">
                <input type="hidden" name="roadshow_scene_id">

                <table class="am-table  table-main">
                    <thead>
                      <tr>
                        <th class="">举办日期</th>
                        <th class="">场次名称</th>
                        <th class="">举办城市</th>
                        <th class="">剩余名额</th>
                        <th class="">状态</th>
                        <th class="table-set"></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php $date = date('Y-m-d', time());?>
                    @foreach($roadshow_scenes as $r)
                    <tr>
                        <td>{{{$r->scene_date}}}</td>
                        <td><a href="{{{action('RoadshowSceneController@getSceneDetail', array($r->id))}}}" target="_blank">{{{$r->title}}}</a></td>
                        <td>{{{$r->province['province_name']}}} {{{$r->city['city_name']}}}</td>
                        <td>{{{$r->seats - $r->projectRoadshows->count()}}}/{{{$r->seats}}}</td>
                        <td>@if($r->scene_date > $date) 未开始 @elseif($r->scene_date == $date) 进行中 @else 已结束 @endif </td>
                        <td>
                            @if($r->state == '1' && $r->projectRoadshows->count() < $r->seats)
                            <button class="apply-roadshow-btn am-btn am-btn-success am-btn-xs " data-roadshow-scene-id="{{{$r->id}}}">
                                <span class="am-icon-info-circle"></span>
                                申请参加
                            </button>
                            @else
                            <button class="am-btn am-btn-success am-btn-xs " disabled>
                                <span class="am-icon-info-circle"></span>
                                申请参加
                            </button>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(count($roadshow_scenes) == 0)
                    <div class="admin-empty-content-note">您项目所在地暂无相关路演场次，我们会尽快安排相应场次，敬请期待</div>
                @endif

            </form>
            <?php echo $roadshow_scenes->links();?>

    </div>
</div>

@stop

@section('page_js')
<script>
    $(function(){
        //点击发送短信验证码
        $('.apply-roadshow-btn').click(function () {

            if(confirm('确认参加该场次路演？')){
                var roadshow_scene_id = $(this).attr('data-roadshow-scene-id');
                $('input[name="roadshow_scene_id"]').val(roadshow_scene_id);
                $('#form').submit();
            }

            return false;
        });
    });

</script>
@stop