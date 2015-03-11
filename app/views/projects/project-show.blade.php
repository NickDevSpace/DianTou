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
					<h1>菲星智能行记录导航仪FX9</h1>
					<span>发起人:菲星数码 </span>
					<span style="margin-left:100px">行业 :电子/数码</span>
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
      							<h2>	关于我</h2>
								<p>	<br />
								</p>
								<p class="MsoNormal">	2004年，在菲星创始人冯海文先生领航下，一支年轻团队怀揣先进的<span>DV</span>闪存和高清技术，立志用影像改变世界，建立了第一个研发与生产中心，在数码影像领域开始了探索，菲星传奇由此拉开序幕。经过<span>10</span>年的发展，分别在香港、纽约、新加坡、广州等地以独资、合资、合作等方式建立了覆盖全球的专业研发机构生产中心和品牌运营基地，目前已涵盖<span>MP3</span>，数码相机，数码摄像机及行车记录仪等多种时尚影音数码产品。展望未来，冯海文更以成就数码科技梦想作为伟大使命。坚持“追求卓越，创造共赢”的经营理念，凭借雄厚的资金实力和强大的技术研发团队，秉承合作共赢的发展宗旨，不断创新，以精益求精的专业精神致力于卓越的产品和服务，为消费者带来更好更多的产品……<span>.</span> </p>
								<p>	<br />
								</p>
								<h2>	我想要做什么</h2>
								<p><img src="/upload/tmp/dota.jpg"></img></p>
								<h2>	为什么我需要你的支持及资金用途</h2>
								<p>	<span style="color:#282828;font-family:'open sans', arial, 'hiragino sans gb', 'microsoft yahei', 微软雅黑, stheiti, 'wenquanyi micro hei', simsun, sans-serif;font-size:14px;line-height:24px;background-color:#ffffff;">我们是一群喜爱影音产品同时有理想的人，多年以来一直致力于消费者享受更时尚的影音产品。我们希望通过“众筹网”能打开市场的知名度，更希望能够筹到更多消费者对于我们创意理念的支持。同时，我们也希望您能参与到产品的持续改进和分享中来，以我为人人，人人为我来网聚大家的力量。此次筹集的资金将全部用于下一代新产品的研发及深度改进，所有支持者都有机会成为首批受惠消费者。</span> </p>
								<h2>	可能存在的风险</h2>
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
							     <article class="am-comment"> <!-- 评论容器 -->
								  <a href="">
								    <img class="am-comment-avatar" alt="" src="http://zcr2.ncfstatic.com/avatar/000/76/53/82virtual_avatar_small.jpg"/>
								  </a>
								
								  <div class="am-comment-main"> <!-- 评论内容容器 -->
								    <header class="am-comment-hd">
								      <!--<h3 class="am-comment-title">评论标题</h3>-->
								      <div class="am-comment-meta"> <!-- 评论元数据 -->
								        <a href="#link-to-user" class="am-comment-author">陈冲</a> <!-- 评论者 -->
								        评论于 <time datetime="">2015.03.07</time>
								      </div>
								    </header>
								
								    <div class="am-comment-bd">可以的</div> 
								  </div>
								</article>
							     
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