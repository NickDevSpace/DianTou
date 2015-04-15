@extends('......layouts.admin-master')

@section('admin-content')
<div class="am-cf am-padding">
  <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">路演验收详情</strong> / <small>Roadshow Acceptance Detail</small></div>
    <div class="am-fr am-cf">		  <button type="button" class="admin-back-btn am-btn am-btn-default">返回</button>
    </div>

</div>
<hr/>
<div class="am-g">
	  <div class="am-u-sm-12">
				<div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">项目名称</div>
				  <div class="am-u-sm-9">
						{{{$project_roadshow->project['project_name']}}}
				  </div>
				</div>
				<div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">路演时间</div>
				  <div class="am-u-sm-9">
						{{{$project_roadshow->roadshowScene['scene_date']}}}
				  </div>
				</div>
				<div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">路演城市</div>
				  <div class="am-u-sm-9">
					  {{{$project_roadshow->roadshowScene->province['province_name']}}} {{{$project_roadshow->roadshowScene->city['city_name']}}}                  </div>
				</div>
				<div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">是否出席</div>
				  <div class="am-u-sm-9">
					@if($project_roadshow->attended == 'Y') 是 @else 否 @endif
				  </div>
				</div>
			  <div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">路演视频URL</div>
				  <div class="am-u-sm-9">
					  {{{$project_roadshow->show_video}}}
				  </div>
			  </div>
			  <div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">路演详情</div>
				  <div class="am-u-sm-9">
					  {{{$project_roadshow->show_detail}}}
				  </div>
			  </div>
			  <div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">综合评分</div>
				  <div class="am-u-sm-9">
					  {{{$project_roadshow->point}}}
				  </div>
			  </div>
			  <div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">并使项目进入</div>
				  <div class="am-u-sm-9">
					  {{{Config::get('app.DICT.PROJECT_STATE')[$project_roadshow->project['state']]}}}
				  </div>
			  </div>
			  <div class="am-g am-margin-top">
				  <div class="am-u-sm-3 am-text-right">验收人</div>
				  <div class="am-u-sm-9">
					  {{{$project_roadshow->acceptUser['nickname']}}}
				  </div>
			  </div>

				<div class="am-u-sm-3 am-u-sm-centered">
					<div class="am-margin">
						<button id="back-btn" type="button" class="admin-back-btn am-btn am-btn-primary">确认并返回</button>
					</div>

				</div>
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