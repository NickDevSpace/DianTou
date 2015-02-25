@extends('layouts.master')
@section('page_title')
首页 | 点投
@stop
@section('head')
    <style>
        .get {
            background: #1E5B94;
            color: #fff;
            text-align: center;
        }

        .get-title {
            font-size: 200%;
            border: 2px solid #fff;
            padding: 20px;
            display: inline-block;
        }

        .get-btn {
            background: #fff;
        }

        .detail {
            margin-top:25px;
            background: #fff;
        }



        .hope {
            background: #0bb59b;
            padding: 50px 0;
        }

        .hope-img {
            text-align: center;
        }

        .hope-hr {
            border-color: #149C88;
        }

        .hope-title {
            font-size: 140%;
        }

        .footer p {
            color: #7f8c8d;
            margin: 0;
            padding: 15px 0;
            text-align: center;
            background: #2d3e50;
        }
		
		.am-thumbnail .am-progress{
			margin-bottom:1rem;
		}
		
    </style>
@stop

@section('content')
<div class="get">
    <div class="am-slider am-slider-default" data-am-flexslider>
      <ul class="am-slides">
        <li><img src="http://zcr3.ncfstatic.com/attachment/201502/09/16/1423469876.jpg" /></li>
        <li><img src="http://zcr3.ncfstatic.com/attachment/201502/10/10/1423536403.jpg" /></li>
        <li><img src="http://zcr3.ncfstatic.com/attachment/201502/10/15/1423553026.jpg" /></li>
      </ul>
    </div>
</div>
<div class="am-container">

<h1>热门项目</h1>
<hr/>
<div class="detail">

<div class="am-g">
	
	
  <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
    <div class="am-thumbnail">
      <img src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg" alt=""/>
      <div class="am-thumbnail-caption">
        <h3>北京烤鸭店</h3>
        <p>买你妈了隔壁买你妈了隔壁买你妈了隔壁</p>
        <div class="am-progress am-progress-sm">
			<div class="am-progress-bar" style="width: 30%"></div>
		</div>
		<div style="font-size:12px; overflow:hidden;">
		<div style="clear:both"></div>
		<span class="am-fl">30%</span>
		<span class="am-fr">剩余20天</span>
		</div>
      </div>
    </div>
  </div>

  <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
    <div class="am-thumbnail">
      <img src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg" alt=""/>
      <div class="am-thumbnail-caption">
        <h3>北京烤鸭店</h3>
        <p>买你妈了隔壁买你妈了隔壁买你妈了隔壁</p>
        <div class="am-progress am-progress-sm">
			<div class="am-progress-bar" style="width: 30%"></div>
		</div>
		<div style="font-size:12px; overflow:hidden;">
		<div style="clear:both"></div>
		<span class="am-fl">30%</span>
		<span class="am-fr">剩余20天</span>
		</div>
      </div>
    </div>
  </div>
  <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
    <div class="am-thumbnail">
      <img src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg" alt=""/>
      <div class="am-thumbnail-caption">
        <h3>北京烤鸭店</h3>
        <p>买你妈了隔壁买你妈了隔壁买你妈了隔壁</p>
        <div class="am-progress am-progress-sm">
			<div class="am-progress-bar" style="width: 30%"></div>
		</div>
		<div style="font-size:12px; overflow:hidden;">
		<div style="clear:both"></div>
		<span class="am-fl">30%</span>
		<span class="am-fr">剩余20天</span>
		</div>
      </div>
    </div>
  </div>
  <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
    <div class="am-thumbnail">
      <img src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg" alt=""/>
      <div class="am-thumbnail-caption">
        <h3>北京烤鸭店</h3>
        <p>买你妈了隔壁买你妈了隔壁买你妈了隔壁</p>
        <div class="am-progress am-progress-sm">
			<div class="am-progress-bar" style="width: 30%"></div>
		</div>
		<div style="font-size:12px; overflow:hidden;">
		<div style="clear:both"></div>
		<span class="am-fl">30%</span>
		<span class="am-fr">剩余20天</span>
		</div>
      </div>
    </div>
  </div>
  <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
    <div class="am-thumbnail">
      <img src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg" alt=""/>
      <div class="am-thumbnail-caption">
        <h3>北京烤鸭店</h3>
        <p>买你妈了隔壁买你妈了隔壁买你妈了隔壁</p>
        <div class="am-progress am-progress-sm">
			<div class="am-progress-bar" style="width: 30%"></div>
		</div>
		<div style="font-size:12px; overflow:hidden;">
		<div style="clear:both"></div>
		<span class="am-fl">30%</span>
		<span class="am-fr">剩余20天</span>
		</div>
      </div>
    </div>
  </div>
  <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
    <div class="am-thumbnail">
      <img src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg" alt=""/>
      <div class="am-thumbnail-caption">
        <h3>北京烤鸭店</h3>
        <p>买你妈了隔壁买你妈了隔壁买你妈了隔壁</p>
        <div class="am-progress am-progress-sm">
			<div class="am-progress-bar" style="width: 30%"></div>
		</div>
		<div style="font-size:12px; overflow:hidden;">
		<div style="clear:both"></div>
		<span class="am-fl">30%</span>
		<span class="am-fr">剩余20天</span>
		</div>
      </div>
    </div>
  </div>
  <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
    <div class="am-thumbnail">
      <img src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg" alt=""/>
      <div class="am-thumbnail-caption">
        <h3>北京烤鸭店</h3>
        <p>买你妈了隔壁买你妈了隔壁买你妈了隔壁</p>
        <div class="am-progress am-progress-sm">
			<div class="am-progress-bar" style="width: 30%"></div>
		</div>
		<div style="font-size:12px; overflow:hidden;">
		<div style="clear:both"></div>
		<span class="am-fl">30%</span>
		<span class="am-fr">剩余20天</span>
		</div>
      </div>
    </div>
  </div>
  <div class="am-u-sm-6 am-u-md-4 am-u-lg-3">
    <div class="am-thumbnail">
      <img src="http://zcr2.ncfstatic.com/attachment/201502/03/16/54d080d51d8d3_230x175.jpg" alt=""/>
      <div class="am-thumbnail-caption">
        <h3>北京烤鸭店</h3>
        <p>买你妈了隔壁买你妈了隔壁买你妈了隔壁</p>
        <div class="am-progress am-progress-sm">
			<div class="am-progress-bar" style="width: 30%"></div>
		</div>
		<div style="font-size:12px; overflow:hidden;">
		<div style="clear:both"></div>
		<span class="am-fl">30%</span>
		<span class="am-fr">剩余20天</span>
		</div>
      </div>
    </div>
  </div>
  
</div>

<div class="hope">
    <div class="am-g am-container">
        <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
            <img src="assets/i/examples/landing.png" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
            <hr class="am-article-divider am-show-sm-only hope-hr">
        </div>
        <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
            <h2 class="hope-title">同我们一起打造你的前端框架</h2>

            <p>
                在知识爆炸的年代，我们不愿成为知识的过客，拥抱开源文化，发挥社区的力量，参与到Amaze Ui开源项目能获得自我提升。
            </p>
        </div>
    </div>
</div>
@stop