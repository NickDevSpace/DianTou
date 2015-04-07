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
                <li><a href="#">融资信息</a></li>
                <li class="am-active"><a href="#">确认信息</a></li>
                <li><a href="#">完成</a></li>
            </ul>
        </div>
        <div class="am-g">
            <form id="confirm-info-form" action="{{{action('ProjectController@postConfirmInfo')}}}" method="post" class="am-form am-form-horizontal">

                <input type="hidden" name="project_id" value="{{{$project->id}}}">
                <input type="hidden" name="save_action">

                <div style="margin:30px auto 50px;">
                <p>点投提醒：请务必再次确认您所填写的内容真实有效，完善且真实的信息能够提高审核通过率，也有助于您的项目获得更多投资人的青睐。您可以通过<a href="#">预览项目</a>来查看项目是否符合您的要求。</p>
                </div>


                <div class="am-form-group">
                    <div class="am-u-sm-7 am-u-sm-centered">
                      <div class="checkbox">
                          <input type="checkbox" checked="checked"> 我已同意并签署<a href="#">点投网服务协议</a>
                      </div>
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-7 am-u-sm-centered">
                    <button id="before-btn" type="button" class="am-btn am-btn-default">&nbsp;&nbsp;上一步&nbsp;&nbsp;</button>
                    <button id="submit-btn" type="button" class="am-btn am-btn-success">&nbsp;&nbsp;确认并提交审核&nbsp;&nbsp;</button>
                    <button id="save-draft-btn" type="button" class="am-btn am-btn-secondary">保存草稿</button>

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
    $('#submit-btn').on('click', function(){
        $('input[name="save_action"]').val('submit');
        $('#confirm-info-form').submit();
    });

    $('#save-draft-btn').on('click', function(){
        $('input[name="save_action"]').val('draft');
        $('#confirm-info-form').submit();
    });

    $('#before-btn').on('click', function(){
        $('input[name="save_action"]').val('back');
        $('#confirm-info-form').submit();
    });

	$(function(){
		App.init(['project.create']);
	});





</script>
@stop

