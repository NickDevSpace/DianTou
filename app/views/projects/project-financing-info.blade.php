@extends('layouts.master')
@section('page_title')
发起项目 | 点投
@stop
@section('head')
    <link rel="stylesheet" href="{{{asset('assets/vendor/kindeditor/themes/default/default.css')}}}"/>
    <link rel="stylesheet" href="{{{asset('assets/vendor/jcrop/css/jquery.Jcrop.css')}}}"/>
    <style>
        .content-main {
            padding: 10px 0;
        }
        .content-header{
            margin-top:30px;
        }
        .steps {
            margin-bottom: 30px;
        }
        .steps .am-nav-pills > li{
            text-align: center;
            width:24%;
        }

        .steps .am-nav-pills > li > a {
             border-radius: 0;
             color: #585858;
             font-size: 16px;
             margin: 0 20px 0 0;
             padding: 0 15px 5px;
             display: inline-block;
         }

         .steps .am-nav-pills > li > a:hover {
              background-color: #fff;
              border-bottom: 4px solid #008e59;
              color: #008e59;
          }

        .steps .am-nav-pills > li.am-active > a, .i-nav .am-nav-pills > li.am-active > a:hover {
             background-color: #fff;
             border-bottom: 4px solid #008e59;
             color: #008e59;
         }

         .steps .am-nav-pills{
             border-bottom: 1px solid #e7e9ec;
         }

        .tips{
            height:800px;
        }

        .tips-list li{
            margin-bottom:20px;
        }

    </style>

@stop
@section('content')
<div class="content-header am-container">
    <h1>发起项目</h1>
    <hr/>

</div>

<div class="content-main am-container">
    <div class="am-u-sm-8">
        <div class="steps">
            <ul class="am-nav am-nav-pills">
                <li><a>项目信息</a></li>
                <li  class="am-active"><a href="#">融资信息</a></li>
                <li><a href="#">确认信息</a></li>
                <li><a href="#">完成</a></li>
            </ul>
        </div>
        <div class="am-g">
            <form id="financing-info-form" action="{{{action('ProjectController@postFinancingInfo')}}}" method="post" class="am-form am-form-horizontal">

                <input type="hidden" name="project_id" value="{{{$project->id}}}">
                <input type="hidden" name="save_action">

                <div class="am-form-group">
                    <label for="i-total-quota" class="am-u-sm-3 am-form-label">拟融资金额（元）</label>
                    <div class="am-u-sm-8 am-u-end">
                        <input type="number" id="i-total-quota" name="raise_quota" value="{{{$project->raise_quota}}}" placeholder="填写该项目融资所需的总金额（元）" data-validate-message="融资总额必须为大于等于10000" min="10000" required>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-max-raise_quota" class="am-u-sm-3 am-form-label">最大融资阈值（元）</label>
                    <div class="am-u-sm-8 am-u-end">
                        <input type="number" id="i-max-raise_quota" name="max_raise_quota" value="{{{$project->max_raise_quota}}}" placeholder="填写该项目融资所需的总金额（元）" data-validate-message="融资总额必须为大于等于10000" min="10000" required>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-min-raise-quota" class="am-u-sm-3 am-form-label">最小融资阈值（元）</label>
                    <div class="am-u-sm-8 am-u-end">
                        <input type="number" id="i-min-raise-quota" name="min_raise_quota" value="{{{$project->min_raise_quota}}}" placeholder="填写该项目融资所需的总金额（元）" data-validate-message="融资总额必须为大于等于10000" min="10000" required>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-assign-share" class="am-u-sm-3 am-form-label">出让股份占比（%）</label>
                    <div class="am-u-sm-8 am-u-end">
                        <input type="number" id="i-assign-share" name="assign_share" value="{{{$project->assign_share}}}" placeholder="出让股份占比" data-validate-message="项目方出资金额不能大于融资总额" min="0" required>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="i-retain-stockholder" class="am-u-sm-3 am-form-label">当前股东人数</label>
                    <div class="am-u-sm-8 am-u-end">
                        <input type="number" id="i-retain-stockholder" name="retain_stockholder" value="{{{$project->retain_stockholder}}}" placeholder="填写该项目目前的股东人数" data-validate-message="请填写介于1-199的整数" min="1" max="199"required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-min-sub-quota" class="am-u-sm-3 am-form-label">单人最小投资金额（元）</label>
                    <div class="am-u-sm-8 am-u-end">
                        <input type="number" id="i-min-sub-quota" name="min_sub_quota" value="{{{$project->min_sub_quota}}}" placeholder="单人最小投资金额" data-validate-message="单人最小投资金额必须xxxx"  required>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="" class="am-u-sm-3 am-form-label">融资期限（天）</label>
                    <div class="am-u-sm-8 am-u-end">
                        <input type="number" id="i-assign-copies" name="raise_days" value="{{{$project->raise_days}}}" placeholder="融资期限" data-validate-message="融资期限必须为大于0小于365的整数" min="1" max="365" required>
                    </div>
                </div>

                <div class="am-form-group">
                    <label for="" class="am-u-sm-3 am-form-label">是否允许其他城市用户投资</label>
                    <div class="am-u-sm-8 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(array('value'=>'Y', 'text'=>'是'), array('value'=>'N', 'text'=>'否')), 'value_field'=>'value','text_field'=>'text', 'id' => 'i-allow-nolocal', 'name' => 'allow_nolocal', 'selected'=> $project->allow_nolocal,'required' => 'true')); ?>
                    </div>
                </div>

                <div class="am-form-group">
                    <div class="am-u-sm-6 am-u-sm-centered">
                    <button id="before-btn" type="button" class="am-btn am-btn-default">&nbsp;&nbsp;上一步&nbsp;&nbsp;</button>
                    <button id="submit-btn" type="button" class="am-btn am-btn-success">&nbsp;&nbsp;下一步&nbsp;&nbsp;</button>

                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="am-u-sm-4">
        <div class="tips am-panel am-panel-default">
            <div class="am-panel-bd">
                <h4>点投小贴士：</h4>

                <ul class="tips-list">
                    <li>填写项目信息有哪些要求吗?<br/><br/>
                        答：对于必填选项，融资人应据实完整填写，对于选填选项应当据实尽量填写，建议信息填写完整度不低于80%。
                    </li>
                    <li>上传项目中项目标签有什么重要性呢？<br/><br/>
                        答：项目标签直接体现行业属性，精准的标签分类便于为您推荐更专业的接洽人。
                    </li>
                    <li>一定要上传我的商业计划书吗？<br/><br/>
                        答：优秀商业计划书能提升项目价值，提高审核通过率。
                    </li>
                    <li>对项目预计融资金额有什么要求吗？<br/><br/>
                        答：合理的预计融资金额可对项目审核期待积极作用。
                    </li>
                    <li>上传项目信息后要想修改了怎么办？<br/><br/>
                        答：信息通过审核后不能修改，请反复确认填写信息的准确度，这样才能确保项目上传成功哦。
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>


<div id="cover-editor" class="am-modal am-modal-confirm" tabindex="-1" >
  <div class="am-modal-dialog">
    <div class="am-modal-hd">图片裁剪</div>
    <div class="am-modal-bd">
        <div id="crop-container"></div>
        <span id="crop-tip"></span>
    </div>
    <div class="am-modal-footer">
      <span class="am-modal-btn" data-am-modal-confirm>确定</span>
      <span class="am-modal-btn" data-am-modal-cancel>取消</span>
    </div>
  </div>
</div>

</div>

@stop

@section('vendor_js')
<script src="{{{asset('assets/js/json2.js')}}}"></script>
<script src="{{{asset('assets/vendor/kindeditor/kindeditor-min.js')}}}"></script>
<script src="{{{asset('assets/vendor/kindeditor/lang/zh_CN.js')}}}"></script>
<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
<script src="{{{asset('assets/vendor/jcrop/js/jquery.Jcrop.min.js')}}}"></script>
@stop
@section('page_js')
<script>
    
	$(function(){

	    $('#submit-btn').on('click', function(){
            $('input[name="save_action"]').val('submit');
            $('#financing-info-form').submit();
        });

        $('#before-btn').on('click', function(){
            $('input[name="save_action"]').val('back');
            $('#financing-info-form').submit();
        });

		App.init(['project.create']);
	});





</script>
@stop

