@extends('layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">路演管理</strong> / <small>新增场次</small></div>
</div>
<hr/>

<div class="am-g">
    <div class="am-u-sm-12 am-u-md-8">
      <form class="am-form am-form-horizontal" action="{{{action('RoadshowManageController@postSave')}}}" method="post">
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">举办省份</label>
          <div class="am-u-sm-5">
            <?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'required' => 'true')); ?>
          </div>
          <div class="am-u-sm-4 am-u-end">
            <?php echo Form::amSelect(array('list'=>$city_select, 'value_field'=>'city_code','text_field'=>'city_name', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'required' => 'true')); ?>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-name" class="am-u-sm-3 am-form-label">举办时间</label>
          <div class="am-u-sm-9">
            <input type="text" id="i-scene-date" name="scene_date" class="am-form-field" placeholder="举办日期" data-am-datepicker="{theme: 'success'}" readonly/>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">名称</label>
          <div class="am-u-sm-9">
            <input type="text" name="title" placeholder="名称" data-validate-message="名称不能为空" required>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">举办地址</label>
          <div class="am-u-sm-9">
            <input type="text" name="address" placeholder="举办地址" data-validate-message="举办地址不能为空" required>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">名额</label>
          <div class="am-u-sm-9">
            <input type="number" name="seats" placeholder="名额" data-validate-message="名额必须是大于0的整数" required>
          </div>
        </div>
        <div class="am-form-group">
          <label for="user-email" class="am-u-sm-3 am-form-label">详情</label>
          <div class="am-u-sm-9">
            <textarea rows="8" name="detail" placeholder="详情"></textarea>
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