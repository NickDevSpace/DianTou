@extends('...layouts.master')

@section('page_title')
场次信息 - 点投
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

        <strong class="am-text-primary am-text-lg">路演场次信息</strong>
        <hr>
        <div class="am-u-sm-10 am-u-sm-centered text-align-center">
        <table class="am-table am-table-bordered">
            <tr>
                <td style="width:20%">场次名称</td>
                <td>{{{$roadshow_scene->title}}}</td>
            </tr>
            <tr>
                <td>城市</td>
                <td>{{{$roadshow_scene->province['province_name']}}} {{{$roadshow_scene->city['city_name']}}}</td>
            </tr>
            <tr>
                <td>举办时间</td>
                <td>{{{$roadshow_scene->scene_date}}}</td>
            </tr>
            <tr>
                <td>举办地址</td>
                <td>{{{$roadshow_scene->address}}}</td>
            </tr>
            <tr>
                <td>名额</td>
                <td>{{{$roadshow_scene->seats}}}</td>
            </tr>
            <tr>
                <td>当前状态</td>
                <td>@if($roadshow_scene->state == '1') 未开始 @elseif($roadshow_scene->state == '2') 进行中 @else 已结束 @endif</td>
            </tr>
            <tr>
                <td>详情</td>
                <td><pre>{{{$roadshow_scene->detail}}}</pre></td>
            </tr>
            <tr>
                <td>已报名项目</td>
                <td>
                    @foreach($roadshow_scene->projectRoadshows as $s)
                        {{{$s->show_seq}}} - <a href="{{{action('ProjectController@getShow', array($s->project['id']))}}}">{{{$s->project['project_name']}}}</a> <br/>
                    @endforeach
                </td>
            </tr>
        </table>

        </div>




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