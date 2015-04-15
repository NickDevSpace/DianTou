@extends('layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">路演审核</strong> / <small>填写路演结论</small></div>
</div>
<hr/>

<div class="am-g">
    <div class="am-u-sm-12 am-u-md-8">
      <form id="form" class="am-form am-form-horizontal" action="{{{action('AdminAuditController@postRoadshowDoAcceptance')}}}" method="post">
        <input type="hidden" name="project_roadshow_id" value="{{{$project_roadshow->id}}}">
          <input type="hidden" name="accept_state" value="1">
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">项目名称</label>
          <div class="am-u-sm-9 admin-form-desc">
            {{{$project_roadshow->project['project_name']}}}
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">是否出席</label>
          <div class="am-u-sm-9">
            <?php echo Form::amSelect(array('list'=>array(array('dict_key'=>'Y', 'dict_value'=>'是'), array('dict_key'=>'N', 'dict_value'=>'否')), 'value_field'=>'dict_key','text_field'=>'dict_value', 'id' => 'i-attended', 'name' => 'attended', 'selected'=>$project_roadshow->attended, 'required' => 'true')); ?>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">路演视频URL</label>
          <div class="am-u-sm-9">
            <input type="text" name="show_video" value="{{{$project_roadshow->show_video}}}"placeholder="支持优酷URL" data-validate-message="" >
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">路演详情</label>
          <div class="am-u-sm-9">
            <textarea rows="10" name="show_detail"  placeholder="请详细描述真实路演状况">{{{$project_roadshow->show_detail}}}</textarea>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">综合评分</label>
          <div class="am-u-sm-9">
            <input type="text" name="point" value="{{{$project_roadshow->point}}}" placeholder="请填写0.00 ~ 10.00之间的数值" data-validate-message="综合评分必须大于0小于等于10" required>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">并使项目</label>
          <div class="am-u-sm-9">
            <?php echo Form::amSelect(array('list'=>array(array('dict_key'=>'APPOINTMENT', 'dict_value'=>'进入预约状态'), array('dict_key'=>'RAISE', 'dict_value'=>'进入融资状态'), array('dict_key'=>'2', 'dict_value'=>'项目结束')), 'value_field'=>'dict_key','text_field'=>'dict_value', 'id' => 'i-attended', 'name' => 'next_state', 'selected'=>$project_roadshow->next_state, 'required' => 'true')); ?>
          </div>
        </div>

        <div class="am-form-group">
          <div class="am-u-sm-9 am-u-sm-push-3">
            <button id="ok-btn" type="button" class="am-btn am-btn-primary">确认完成</button>
            <button id="save-btn" type="button" class="am-btn am-btn-secondary">保存草稿</button>
            <button type="button" class="admin-back-btn am-btn am-btn-default">返回</button>
          </div>
        </div>
      </form>
    </div>

</div>
@stop

@section('page_js')
<script>
    $(function(){
        $('#ok-btn').on('click', function(){
            if(confirm('确认该项目通过路演验收？')){
                $('input[name="accept_state"]').val("3");
                if(checkForm()){
                    $('#form').submit();
                }
            }
        });

        $('#save-btn').on('click', function(){
            $('input[name="accept_state"]').val("2");
            if(checkForm()){
                $('#form').submit();
            }
        });

        function checkForm(){
            return true;
        }
    });

</script>
@stop