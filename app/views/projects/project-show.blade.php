@extends('layouts.master')
@section('page_title')
{{{$project->project_name}}} - 项目详情 - 点投
@stop
@section('head')
<style>


</style>
<script>
    var Project = {
        id : '{{{$project->id}}}',
        project_name : '{{{$project->project_name}}}'
    };
    var Route = {
        show_subscriptions : '{{{action('ProjectController@getShowSubscriptions')}}}/' + Project.id,
        show_project_life_events : '{{{action('ProjectController@getShowProjectLifeEvents')}}}/' + Project.id,
        show_comments : '{{{action('ProjectController@getShowComments')}}}/' + Project.id,
        post_comments : '{{{action('ProjectCommentController@postSave')}}}'
    };
</script>
@stop

@section('content')
<div class="top-container am-container">
    <div class="am-u-sm-5">
        <div class="banner-img">
            <span>{{{Config::get('app.DICT.PROJECT_STATE')[$project->state]}}}</span>
            <img src="/{{{$project->project_cover}}}" width="420">
        </div>
        <div class="banner-share">
            <!-- JiaThis Button BEGIN -->
            <div class="jiathis_style"><span class="jiathis_txt">分享到：</span>
            <a class="jiathis_button_weixin"></a>
            <a class="jiathis_button_tsina"></a>
            <a class="jiathis_button_tqq"></a>
            <a class="jiathis_button_renren"></a>
            <a class="jiathis_button_douban"></a>
            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jiathis_separator jtico jtico_jiathis" target="_blank"></a>
            <a class="jiathis_counter_style"></a>
            </div>
            <script type="text/javascript" >
            var jiathis_config={
            	summary:"",
            	shortUrl:true,
            	hideMore:false
            }
            </script>
            <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
            <!-- JiaThis Button END -->

        </div>
    </div>
    <div class="am-u-sm-7">
        <div class="banner-title">
            <h1>{{{$project->project_name}}}</h1>
            <span class="banner-sub-title">{{{$project->sub_title}}}</span>
            <a href="#" style="position: absolute; top:0; right:0"><span class="am-badge am-badge-warning am-text-default" >加关注</span></a>
        </div>
        <div class="banner-base-info">
            <span class="banner-text">发起人：{{{$project->user['nickname']}}}</span>
            <span class="banner-text">行业：{{{$project->industry->parentIndustry['industry_name']}}} {{{$project->industry['industry_name']}}}</span>
            <span class="banner-text">城市：{{{$project->province['province_name']}}} {{{$project->city['city_name']}}}</span>
            <span class="banner-text">融资金额：￥{{{$project->raise_quota}}}</span>
            <span class="banner-text">出让股份：{{{$project->assign_share}}}%</span>
            <span class="banner-text">起投金额：￥{{{$project->min_sub_quota}}}</span>

        </div>
        <div class="banner-finance-info">
            <?php $progress = $project->raised_bal * 100/ $project->raise_quota;?>
            <?php $left_days = $project->raise_end_date ? DateUtil::leftDays($project->raise_end_date) : $project->raise_days; ?>
            <div class="clearfix" style="overflow:hidden;">
                <div class="finance-text" style="border-right:1px dotted #eee; width:50%; float:left; text-align: center">
                    <p style="font-size:2em">{{{$progress}}}%</p>
                    <p style="color:#666;font-size:1em">已完成</p>
                </div>
                <div class="finance-text" style="width:50%; float:right; text-align: center">
                    <p><span style="font-size:2em">{{{$left_days}}}</span><span style="font-size:1em">/{{{$project->raise_days}}}天</span></p>
                    <p style="color:#666;font-size:1em">剩余天数</p>
                </div>
            </div>
            <div class="am-progress">
                <div class="am-progress-bar" style="width: {{{$progress}}}%">{{{$progress}}}%</div>
            </div>
            <div style="margin-top:-10px;">
                <span style="float:left">已融资：<em style="color:#ff5001">￥{{{$project->raised_bal}}}</em></span>
                <span style="float:right">目标金额：￥{{{$project->raise_quota}}}</span>
            </div>
            <div style="margin-top:60px;">
            <button id="sub-btn" type="button" class="am-btn am-btn-success am-btn-block" data-am-modal="{target: '#sub-prompt', closeViaDimmer: 0}">我要投资</button>
            </div>
        </div>
    </div>

</div>
<div class="am-container" style="margin-bottom: 50px;">
    <div class="am-u-sm-8">
        <div class="project-buttons am-tabs" data-am-tabs="{noSwipe: 1}">
             <ul class="am-tabs-nav am-nav am-nav-tabs">
                <li class="am-active"><a href="javascript: void(0)">项目详情</a></li>
                <li><a href="javascript: void(0)">投资记录</a></li>
                <li><a href="javascript: void(0)">大事件</a></li>
                <li><a href="javascript: void(0)">评论</a></li>
             </ul>

             <div class="am-tabs-bd">
                 <div class="show-tab am-tab-panel am-fade am-in am-active" id="tab1">
                        <?php echo $project->detail?>
                 </div>
                 <div class="show-tab am-tab-panel am-fade" id="tab-subs">

                 </div>
                 <div class="show-tab am-tab-panel am-fade" id="tab-events">

                 </div>
                 <div class="show-tab am-tab-panel am-fade" id="tab-comments">

                 </div>
             </div>

        </div>
    </div>
    <div class="am-u-sm-4">
        <div class="am-g">
            <div class="side-item am-panel am-panel-default">
                <div class="am-panel-bd">
                    <div style="position:relative;">
                        <a style="display: block; float:left" href="#">
                            <img src="http://s0.meituan.net/www/img/user-avatar.v9bfc4a71.png" width="48" class="am-img-thumbnail am-circle"/>
                        </a>
                        <div style="float:left; margin-left:20px;"><span style="color:#999">发起人：</span><br/><strong>{{{$project->user['nickname']}}}</strong>
                        </div>
                        <a class="am-badge am-badge-success am-radius am-text-sm" style="position:absolute; top:0; right:0">私信</a>

                        <div class="clearfix"></div>
                    </div>
                    <div style="margin-top:20px;">
                        <p><span style="color:#999">所在城市：</span>{{{$project->user->province['province_name']}}} {{{$project->user->city['city_name']}}}</p>
                        <p><span style="color:#999">个人简介：</span>{{{$project->user['introduction']}}}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="am-modal am-modal-no-btn" tabindex="-1" id="sub-prompt">
  <div class="am-modal-dialog">
    <div class="am-modal-hd">我要投资
      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
    </div>
    <div class="am-modal-bd">
      <form id="sub_form" class="am-form am-form-horizontal" action="{{{action('SubscriptionController@postSaveSub')}}}" method="post">
          <input type="hidden" name="project_id" value="{{{$project->id}}}">
          <div class="am-form-group">
            <label for="user-email" class="am-u-sm-2 am-form-label">投资金额</label>
            <div class="am-u-sm-9 am-u-end">
              <input type="text" data-min="{{{$project->min_sub_quota}}}" data-raise-quota="{{{$project->raise_quota}}}" data-raised-bal="{{{$project->raised_bal}}}" name="sub_amt" value="" placeholder="单位（元），起投金额：￥{{{$project->min_sub_quota}}}" required>

            </div>
          </div>
          <div class="am-g am-margin-top">

            <div class="am-u-sm-2 am-text-right">投资股份</div>
            <div class="am-u-sm-1 am-u-end"><span id="sub_share">0</span>%</div>
          </div>
      </form>
      <div class="am-g" style="margin-top:10px;">
            <div class="am-u-sm-4 am-u-sm-centered"><button id="sub-confirm" type="button" class="am-btn am-btn-success am-btn-block">确认</button></div>
      </div>
    </div>
  </div>
</div>
@stop


@section('vendor_js')
@stop
@section('page_js')
<script>
    $(function(){

        initShowSubscriptions();
        initShowProjectLifeEvents();
        initShowComments();
        function initShowSubscriptions(){
            $.ajax({
                url: Route.show_subscriptions,
                method: 'get',
                success: function(data){
                    $('#tab-subs').html(data);
                }
            });
        }
        function initShowProjectLifeEvents(){
            $.ajax({
                url: Route.show_project_life_events,
                method: 'get',
                success: function(data){
                    $('#tab-events').html(data);
                }
            });
        }

        function initShowComments(){
            $.ajax({
                url: Route.show_comments,
                method: 'get',
                success: function(data){
                    $('#tab-comments').html(data);
                }
            });
        }

        $(document).on('click', '#tab-comments #comment-btn', function(){
            var content = $('#comment-content').val();
            if($.trim(content) == ''){
                alert('请填写评论内容');
                return false;
            }

            $.ajax({
                url: Route.post_comments,
                method: 'post',
                data:{project_id: Project.id, content: content},
                success: function(data){
                    if(data.errno == 'SUCCESS'){
                        initShowComments();
                    }else{
                        alert('评论失败，请重试');
                    }
                }
            });
        });

        $(document).on('click', '.show-tab .am-pagination li a', function(){
            var $e = $(this);
            $.ajax({
                url: $(this).attr('href'),
                method: 'get',
                success: function(data){
                    $e.closest('.show-tab').html(data);
                }
            });
            return false;
        });

        function checkSubForm(){
            var $sub_prompt = $('#sub-prompt');
            var $input = $('#sub_form').find('input[name="sub_amt"]');
            var fieldWrapper = $input.closest('div');
            var sub_amt = Number($input.val());
            var min_sub = Number($input.attr('data-min'));
            var left_amt = Number($input.attr('data-raise-quota')) - Number($input.attr('data-raised-bal'));


            fieldWrapper.find('.am-text-danger').remove();
            if(isNaN(sub_amt)){
                $('<span class="am-text-danger">请填写正确的金额</span>').appendTo(fieldWrapper);
                return false;
            }
            if(sub_amt  < min_sub){
                $('<span class="am-text-danger">投资金额必须大于等于最低投资金额</span>').appendTo(fieldWrapper);
                return false;
            }

            if(sub_amt > left_amt){
                $('<span class="am-text-danger">投资金额不能超过项目剩余认购金额</span>').appendTo(fieldWrapper);
                return false;
            }

            return true;
        }

        $('#sub_form').find('input[name="sub_amt"]').on('keyup', function(e){
            checkSubForm();
            var sub_amt = Number($(this).val());
            var raise_quota = Number($(this).attr('data-raise-quota'));
            $('#sub_share').html((sub_amt * 100 / raise_quota).toFixed(4));
            return false;
        });

        $('#sub-confirm').on('click',function(){
            if(checkSubForm()){
                $('#sub_form').submit();
                $('#sub_prompt').modal('close');
            }
        });



    });
</script>
@stop