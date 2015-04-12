@extends('layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">路演审核</strong> / <small>填写路演结论</small></div>
</div>
<hr/>

<div class="am-g">
    <div class="am-u-sm-12 am-u-md-8">
      <form class="am-form am-form-horizontal" action="{{{action('RoadshowManageController@postSave')}}}" method="post">
        <input type="hidden" name="project_roadshow_id" value="{{{$project_roadshow->id}}}">
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">项目名称</label>
          <div class="am-u-sm-9 admin-form-desc">
            {{{$project_roadshow->project['project_name']}}}
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">是否出席</label>
          <div class="am-u-sm-9">
            <?php echo Form::amSelect(array('list'=>array(array('dict_key'=>'Y', 'dict_value'=>'是'), array('dict_key'=>'N', 'dict_value'=>'否')), 'value_field'=>'dict_key','text_field'=>'dict_value', 'id' => 'i-attended', 'name' => 'attended', 'required' => 'true')); ?>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">路演视频URL</label>
          <div class="am-u-sm-9">
            <input type="text" name="title" placeholder="支持优酷URL" data-validate-message="" >
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">路演详情</label>
          <div class="am-u-sm-9">
            <textarea rows="10" name="detail" placeholder="请详细描述真实路演状况"></textarea>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">综合评分</label>
          <div class="am-u-sm-9">
            <input type="text" name="point" placeholder="请填写0.00 ~ 10.00之间的数值" data-validate-message="综合评分必须大于0小于等于10" required>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">结论</label>
          <div class="am-u-sm-9">
            <?php echo Form::amSelect(array('list'=>array(array('dict_key'=>'1', 'dict_value'=>'通过并准许项目进入预约状态'), array('dict_key'=>'2', 'dict_value'=>'通过并准许项目进入融资状态'), array('dict_key'=>'2', 'dict_value'=>'不通过（项目结束）')), 'value_field'=>'dict_key','text_field'=>'dict_value', 'id' => 'i-attended', 'name' => 'attended', 'required' => 'true')); ?>
          </div>
        </div>

        <div class="am-form-group">
          <div class="am-u-sm-9 am-u-sm-push-3">
            <button type="submit" class="am-btn am-btn-primary">保存</button>
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
        $('#pass-btn').on('click', function(){
            if(confirm('确认该项目通过审核？')){
                $('input[name="audit_state"]').val(1);
                if(checkForm()){
                    $('#form').submit();
                }
            }
        });

        $('#deny-btn').on('click', function(){
            if(confirm('确认该项目不通过审核？')){
                $('input[name="audit_state"]').val(2);
                if(checkForm()){
                    $('#form').submit();
                }
            }
        });

        function checkForm(){
            if($('#i-audit-comment').val().trim() == ''){
                $('<span class="am-text-danger">请填写审核意见</span>').appendTo($('#i-audit-comment').parent());
                return false;
            }else{
                $('#i-audit-comment').parent().find('.am-text-danger').remove();
                return true;
            }
        }
    });

</script>
@stop