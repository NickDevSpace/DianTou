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

        <div class="am-u-sm-10 am-u-sm-centered text-align-center" style="height:200px; vertical-align: middle">
            路演场次申请成功！届时请务必准时参加！<a href="#">查看场次信息</a>
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