@extends('layouts.master')
@section('page_title')
首页 | 点投
@stop
@section('head')
    <style>

        .content-wrapper {
            margin-top:25px;
            background: #fff;
        }

		.am-thumbnail .am-progress{
			margin-bottom:1rem;
		}

        #filter{
            padding:10px 12px;
        }
        #filter li{
            display:inline-block;
            margin: 4px 16px 4px 0;
            vertical-align: top;
        }
        #filter li a{
                    display: block;
                        height: 1.8em;
                        padding: 0 8px;
                        color:#333;
                }
        #filter li a:hover{
            background-color: #009a61;//#2bb8aa;
            border-radius: 4px;
            color: #fff;
            text-decoration: none;
        }
        #filter li.active{
                    background-color: #009a61;//#2bb8aa;
                    border-radius: 4px;
                    color: #fff;
                }
        #filter li.active a{

                                color:#fff;
                        }
        .cate-tag-name{
            margin-right:10px;
            padding:4px 6px;
            text-align: right;
            float:left;
        }
        .search-hot-words{
            clear:both;
            padding:5px 0px;
            overflow:hidden;
            max-height:30px;
        }


        .search-hot-words ul{
            margin:0px;
            padding:0px;
        }
        .search-hot-words li{
            display:inline-block;
            margin-right:12px;
        }
        .side-item{
            text-align:center;
        }
		
    </style>
@stop

@section('content')
<div class="content-wrapper am-container">

    <div class="search-bar am-g">
        <div class="ad-left am-u-sm-3">
            <div style="text-align:center">
                <h1 style="font-weight:bold; font-size:35px; color:#008e59">点投</h1>
            </div>

        </div>
        <div class="am-u-sm-6">
            <div class="am-input-group">
              <input type="text" name="w" class="am-form-field" placeholder="搜索你感兴趣的项目">
              <span class="am-input-group-btn">
                <button class="am-btn am-btn-success" type="button">点投一下</button>
              </span>
            </div>
            <div class="search-hot-words">
                <ul>
                    <li><a href="#">北京烤鸭店</a></li>
                    <li><a href="#">牛排</a></li>
                    <li><a href="#">烧烤</a></li>
                    <li><a href="#">教育</a></li>
                    <li><a href="#">蛋糕</a></li>

                </ul>
            </div>

        </div>
        <div class="ad-right am-u-sm-3">

        </div>

    </div>

    <hr/>
    <div id="filter" class="am-g">
        <div class="am-u-sm-12">
            <div>
                <div class="cate-tag-name">行业分类：</div>
                <ul>
                    <li class="active"><a href="#">全部</a></li>
                    <li><a href="#">美食</a></li>
                    <li><a href="#">休闲</a></li>
                    <li><a href="#">零售</a></li>
                    <li><a href="#">健身</a></li>
                    <li><a href="#">教育</a></li>
                </ul>
            </div>
            <div>
                <div class="cate-tag-name">融资状态：</div>
                <ul>
                    <li class="active"><a href="#">全部</a></li>
                    <li><a href="#">预约中</a></li>
                    <li><a href="#">融资中</a></li>
                    <li><a href="#">融资成功</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="search-result am-g">
        <div class="am-u-sm-9">
            <div class="am-u-sm-4">
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
            <div class="am-u-sm-4">
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
                        <div class="am-u-sm-4">
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
        <div class="am-u-sm-3">

            <div class="am-g">
                <div id="wx-gz" class="side-item am-panel am-panel-default">
                    <img src="http://syl-static.qiniudn.com/img/qrcode.jpg">
                    <p>“扫一扫”关注微信，有惊喜！</p>
                </div>
            </div>
            <div class="am-g">
                <div id="wx-gz" class="side-item am-panel am-panel-default">
                    <span>热门项目推荐</span>
                    <hr/>
                    <p>“扫一扫”关注微信，有惊喜！</p>
                </div>
            </div>
        </div>
    </div>


    <div class="detail">

    <div class="am-g">

    </div>

    </div>
</div>


@stop
@section('page_scripts')
<script>
$(function(){
	App.init(['project.index']);
});
</script>
@stop