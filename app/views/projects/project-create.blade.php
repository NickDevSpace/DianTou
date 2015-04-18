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
                <li class="am-active"><a>项目信息</a></li>
                <li><a href="#">融资信息</a></li>
                <li><a href="#">确认信息</a></li>
                <li><a href="#">完成</a></li>
            </ul>
        </div>
        <div class="am-g">
            <form id="project-create-form" action="{{{action('ProjectController@postSave')}}}" method="post" class="am-form am-form-horizontal">
                <div class="am-form-group">
                    <label for="i-project-name" class="am-u-sm-2 am-form-label">项目名称</label>
                    <div class="am-u-sm-10 am-u-end">
                        <input type="text" id="i-project-name" name="project_name" placeholder="输入项目名称" data-validate-message="项目名称不能为空" required >
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-project-cover" class="am-u-sm-2 am-form-label">项目封面</label>
                    <div class="am-u-sm-6">
                         <div id="cover-picker">选择图片</div>
                         <input type="hidden" id="i-project-cover" name="project_cover"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end">
                         <div id="project-cover-preview"></div>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-sub-title" class="am-u-sm-2 am-form-label">项目标语</label>
                    <div class="am-u-sm-10 am-u-end">
                        <input type="text" name="sub_title" placeholder="输入项目标语" data-validate-message="项目标语不能为空" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-industry-2" class="am-u-sm-2 am-form-label">所属行业</label>
                    <div class="am-u-sm-5">
                        <?php echo Form::amSelect(array('list'=>$industry_select, 'value_field'=>'industry_code','text_field'=>'industry_name', 'header_text' => '请选择', 'id' => 'i-industry-1', 'required' => 'true')); ?>
                    </div>
                    <div class="am-u-sm-5 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_text' => '请选择', 'id' => 'i-industry-2', 'name'=>'industry_code', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-city-code" class="am-u-sm-2 am-form-label">所在城市</label>
                    <div class="am-u-sm-5">
                        <?php echo Form::amSelect(array('list'=>$province_select, 'value_field'=>'province_code','text_field'=>'province_name', 'header_text' => '请选择', 'id' => 'i-province-code', 'name' => 'province_code', 'required' => 'true')); ?>
                    </div>
                    <div class="am-u-sm-5 am-u-end">
                        <?php echo Form::amSelect(array('list'=>array(), 'value_field'=>'','text_field'=>'', 'header_text' => '请选择', 'id' => 'i-city-code', 'name' => 'city_code', 'required' => 'true')); ?>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="address" class="am-u-sm-2 am-form-label">详细地址</label>
                    <div class="am-u-sm-10 am-u-end">
                        <input type="text" id="address" name="address" placeholder="输入详细地址" data-validate-message="项目地址不能为空" required>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="i-detail" class="am-u-sm-2 am-form-label">项目介绍</label>
                    <div class="am-u-sm-10 am-u-end">
                        <textarea id="i-detail" name="detail" style="width:100%;height:400px;visibility:hidden;">
                        <h2>关于我（也可使用个性化小标题）</h2>
                        向支持者介绍你自己或你的团队，并详细说明你与所发起的项目之间的背景，让支持者能够在最短时间内了解你，以拉近彼此之间的距离。
                        <h2>我想要做什么（也可使用个性化小标题）</h2>
                        这是项目介绍中最关键的部分，建议上传5张以上高清图片（宽700、高不限），配合文字来简洁生动地说明你的项目，让支持者对你要做的事情一目了然并充满兴趣。
                        <h2>为什么我需要你的支持及资金用途（也可使用个性化小标题）</h2>
                        请在这一部分说明你的项目不同寻常的特色，为什么需要大家的支持以及详细的资金用途，这会增加你项目的可信度并由此提高筹资的成功率。
                        <h2>可能存在的风险（也可使用个性化小标题）</h2>
                        请在此标注你的项目在实施过程中可能存在的风险，让支持者对你的项目有全面而清晰的认识。
                        </textarea>
                    </div>
                </div>
                <div class="am-form-group">
                    <label for="business_plan" class="am-u-sm-2 am-form-label">项目计划书</label>
                    <div class="am-u-sm-6 am-u-end">
                        <div id="plan-picker" >选择文件</div>
                        <input type="hidden" name="business_plan"/>
                    </div>
                    <div class="am-u-sm-3 am-u-end dt-form-desc">
                        <span id="plan-view"></span>
                    </div>
                </div>
                <div class="am-form-group">
                    <div class="am-u-sm-3 am-u-sm-centered">
                    <button type="submit" class="am-btn am-btn-success">&nbsp;&nbsp;下一步&nbsp;&nbsp;</button>
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
		App.init(['project.create']);
	});





</script>
@stop

