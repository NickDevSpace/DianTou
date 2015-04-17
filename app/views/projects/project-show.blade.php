@extends('layouts.master')
@section('page_title')
项目详情
@stop
@section('head')
	<link rel="stylesheet" href="{{{asset('assets/vendor/kindeditor/themes/default/default.css')}}}"/>
    <link rel="stylesheet" href="{{{asset('assets/vendor/jcrop/css/jquery.Jcrop.css')}}}"/>
    <style>
    	body {
    		background: none repeat scroll 0% 0% #EBEEF1;
    	}
    	.p-status li {
    		background: url("/assets/icons/u2_c2.gif") no-repeat scroll right center transparent;
    		margin-bottom:20px;
    		font-size:1.2em;
    	}
    	
    	.f-status {
    		padding:10px;
    		border-bottom:2px dotted #CCC;
    		border-top:2px dotted #CCC;
    	}
    	
    	.buy-btn {
    		padding:10px;
    		border-bottom:2px dotted #CCC;
    	}
    	
    	p{
    		margin:0!important;
    	}
    	
    	.p-status{
    		padding:10px;
    		margin-top:10px;
    		border-bottom:2px dotted #CCC;
    	}
    
    	.project-detail{
    		padding:100px 50px;
    		width:1200px;
    		margin:10px auto;
    		border:1px solid;
    		border-radius: 18px;
			box-shadow: 0px 0px 25px rgba(0, 0, 0, 0.4);
			background-image:url(/upload/tmp/pro-bg.jpg);
			background-repeat:no-repeat;
			background-color:white;
    	}
    	
    	.project-left{
    	}
    	
    	.project-finance{
    		height:250px;
    		background-color:white;
    		border:1px solid;
    		padding:20px;
    	}
    	
    	.project-baseinfo{
    		position:relative;
    		height:250px;
    		padding:25px 15px;
    		border:1px solid;
    		background-color:white;
    	}
    	
    	.project-right-bottom {
    		margin-top:20px;
    		border:none;
    	}
   		
   		.project-buttons{
   			margin-top:20px;
   			border:1px solid;
   			border-color:#CCC;
   		}
   		
   		#riskhint {
   			color:red;
   			margin-top:10px;
   		}
   		
   		.projectintro{
   			height:500px;
   			background-color:gray;
   			margin-top:100px;
   		}
  
   		.projectbudget{
   			height:500px;
   			background-color:orange;
   			margin-top:100px;
   			opacity:0;
   		}
   		
   		.commentarea{
   			resize:none;
   			border-radius:5px;
   			width:100%;
   			height:100%;
   			border:none;
   		}
    	
    	.projectpan{
    		height:250px;
    		margin-top:30px;
    		background-color:red;
    	}
    	
    	.commentdiv {
    		box-shadow: 0px 0px 3px 0px rgba(0, 0, 0, 0.15) inset;
    		border:1px solid;
    		border-color:#CCC;
    		height:120px;
    		padding:1px;
    	}
    	
    	.comment-list {
    		margin-top:80px;
    	}
    	
    	.cycle-avator {
    		border-radius: 25px;
    		float:left;
    	}
    	
    	.one-comment {
    		padding:5px 20px;
    		border-bottom:1px solid;
    		display:block;
    	}
    	
    	.clear {
    		clear:both;
    	}
    	
    	.cycle-avator img {
    		border-radius: 15px;
    		display:block;
    	}
    	
    	.finance-text {
    		text-align:center;
    	}
    </style>
@stop
@section('content')
<div class="project-detail">
	<div class="am-g">
		<div class="am-container">
			<div class="am-u-sm-8 project-left">
				<div class="project-baseinfo">
					<h1>{{{$project->project_name}}}</h1>
					<span>发起人:{{{$user->nickname}}}</span>
					<span style="margin-left:100px">行业 :{{{$project->industry->industry_name}}}</span>
					<span style="margin-left:100px">地址:浙江省慈溪市宗汉街道</span>
					<div id="riskhint">&nbsp&nbsp&nbsp&nbsp&nbsp风险提示:请您仔细阅读此项目认购协议条款，确认并知晓众筹股权(无保本)投资风险，认购后您将不能更改投资人姓名，也不能代他人认购和转让他人，只以您在XXX平台上身份认证时提交的身份证为准进行投资合同文本签署和工商注册办理.如认购后申请退出，需支付相应反悔金．
请勿相信任何非XXX官方对外公布的承诺或非官方发布的协议。对此，点投将不承担任何法律责任，如需核实信息请拨打官方客服电话：110。</div>
				</div>
				<div class="project-buttons am-tabs" data-am-tabs>
<!-- 					<div class="am-u-sm-6"> -->
<!-- 						<button id="button-intro" type="button" class="am-btn am-btn-primary am-btn-block am-btn-xl">项目介绍</button> -->
<!-- 					</div> -->
<!-- 					<div class="am-u-sm-6"> -->
<!-- 						<button id="button-budget" type="button" class="am-btn am-btn-secondary am-btn-block am-btn-xl">项目预算</button> -->
<!-- 					</div> -->
					 <ul class="am-tabs-nav am-nav am-nav-tabs">
					    <li class="am-active"><a href="javascript: void(0)">项目介绍</a></li>
					    <li><a href="javascript: void(0)">预算</a></li>
					    <li><a href="javascript: void(0)">投资者</a></li>
					    <li><a href="javascript: void(0)">评论</a></li>
					 </ul>
					 
					 <div class="am-tabs-bd">
					 	 <div class="am-tab-panel am-fade am-in am-active" id="tab1">
      							<?php echo $project->detail?>
    					 </div>
    					 <div class="am-tab-panel am-fade" id="tab2">
    					 		预算
    					 </div>
    					 <div class="am-tab-panel am-fade" id="tab3">
							<table class="am-table am-table-striped">
							    <thead>
							        <tr>
							            <th>投资者</th>
							            <th>投资金额</th>
							            <th>时间</th>
							        </tr>
							    </thead>
							    <tbody>
							        <tr>
							            <td>张三</td>
							            <td>20000</td>
							            <td>2015-03-02</td>
							        </tr>
							        <tr>
							            <td>李四</td>
							            <td>30000</td>
							            <td>2015-03-04</td>
							        </tr>
							        <tr>
							            <td>陈冲</td>
							            <td>40000000</td>
							            <td>2015-02-01</td>
							        </tr>
							    </tbody>
							</table>  					 
    					 </div>
    					 <div class="am-tab-panel am-fade" id="tab4">
    					 	 <div class="am-form-group commentdiv">
						      	<textarea class="am-radius commentarea"  id="comment-text"></textarea>
						     </div>						     
						     <button type="button" class="am-btn am-btn-success" style="float:right">提交</button>		
						     <div class="comment-list">
						     @foreach ($comments as $c)
							     <article class="am-comment" style="margin-top:10px"> <!-- 评论容器 -->
								  <a href="">
								    <img class="am-comment-avatar" alt="" src="http://zcr2.ncfstatic.com/avatar/000/76/53/82virtual_avatar_small.jpg"/>
								  </a>
								
								  <div class="am-comment-main"> <!-- 评论内容容器 -->
								    <header class="am-comment-hd">
								      <!--<h3 class="am-comment-title">评论标题</h3>-->
								      <div class="am-comment-meta"> <!-- 评论元数据 -->
								        <a href="#link-to-user" class="am-comment-author">{{{$c->user->nickname}}}</a> <!-- 评论者 -->
								        评论于 <time datetime="">2015.03.07</time>
								      </div>
								    </header>
								
								    <div class="am-comment-bd">{{{$c->content}}}</div> 
								  </div>
								</article>
							 @endforeach
						     </div>
    					 </div>
					 </div>
					
				</div>

			</div>
			<div class="am-u-sm-4 project-right">
				<div class="project-finance">
					<h2 style="color:#666;margin-bottom:10px">已融到资金</h2>
					<p style="font-size:2.5em;border-bottom:1px dotted">￥498,000</p>
					<div style="height:80px;">
						<div class="am-u-sm-6 finance-text" style="border-right:1px dotted">
							<p style="font-size:2em">81%</p>
							<p style="color:#666;font-size:1em">已完成</p>
						</div>
						<div class="am-u-sm-6 finance-text">
							<p><span style="font-size:2em">7</span><span style="font-size:1em">/40天</span></p>
							<p style="color:#666;font-size:1em">剩余天数</p>
						</div>
					</div>
					<div class="am-progress">
  						<div class="am-progress-bar" style="width: 81%">81%</div>
					</div>
				</div>
				<div class="project-right-bottom" style="height:400px">
					<div id="pan" style="height:300px;"></div>
					<div class="f-status">
						<p>1、每份金额：￥10，000</p>
						<p>2、总筹：￥500，000</p>
						<p><span>3、剩余：</span><span style="color:red;">30</span><span> 份</span></p>
					</div>
					<div class="buy-btn">
						<button type="button" class="am-btn am-btn-primary am-btn-block am-btn-xl">我要投资</button>
					</div>
					<div class="p-status"> 
						<ul>
							<li>营业执照</li>
							<li>财务报表</li>
							<li>税务登记证</li>
							<li>法人代表身份证</li>
							<li>场地租赁合同</li>
							<li>行业许可证</li>
							<li>组织机构代码证</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop 


@section('vendor_scripts')
<script src="{{{asset('assets/js/json2.js')}}}"></script>
<script src="{{{asset('assets/vendor/kindeditor/kindeditor-min.js')}}}"></script>
<script src="{{{asset('assets/vendor/kindeditor/lang/zh_CN.js')}}}"></script>
<script src="{{{asset('assets/vendor/webuploader/webuploader.min.js')}}}"></script>
<script src="{{{asset('assets/vendor/jcrop/js/jquery.Jcrop.min.js')}}}"></script>
@stop
@section('page_scripts')
<script type="text/javascript">
	var myChart = echarts.init(document.getElementById('pan'),bluetheme);
	var option = {
		    title : {
		        text: '资金比例',
		        x:'center',
		        textStyle:{
			        fontSize:20,
			        fontWeight:'bolder',
			        color:'black'
			    }
		    },
		    tooltip : {
		        trigger: 'item',
		        formatter: "{a} <br/>{b} : {c} ({d}%)"
		    },
		    toolbox: {
		        show : false
		    },
		    series : [
		        {
		            name:'金额',
		            type:'pie',
		            radius : '70%',
		            center: ['50%', '52%'],
		            data:[
		                {value:100000, name:'项目方出资'},
		                {value:400000, name:'在线融资'},
		            ]
		        }
		    ]
		};         
	myChart.setOption(option);
</script>
@stop