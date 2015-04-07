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
                <li><a href="#">确认信息</a></li>
                <li class="am-active"><a href="#">完成</a></li>
            </ul>
        </div>
        <div class="am-g">


                @if($save_action == 'draft')
                <div class="">
                    <h3>草稿保存成功！</h3>
                    <p>您可以通过“个人中心-项目-我的项目”来查看或修改您所保存的项目。</p>
                    <p>您可以马上去<a href="{{{action('IController@getProjectMy')}}}">个人中心</a>，或<a href="{{{url('/')}}}">返回首页</a></p>
                </div>
                @elseif($save_action == 'submit')
                <div class="">
                    <h3>您的项目已成功提交！</h3>
                    <p>我们会尽快审核您的项目，请您耐心等待。您可以通过“个人中心-项目-我的项目”来查看您所发起的项目状态。</p>
                    <p>您可以马上去<a href="{{{action('IController@getProjectMy')}}}">个人中心</a>，或<a href="{{{url('/')}}}">返回首页</a></p>
                </div>
                @else
                <div class="">
                    <h3>系统错误</h3>
                    <p><a href="{{{url('/')}}}">返回首页</a></p>
                </div>
                @endif

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
		App.init(['project.create']);
	});





</script>
@stop

