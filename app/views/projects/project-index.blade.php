@extends('layouts.master')
@section('page_title')
项目浏览 - 点投
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
    <!-- 搜索部分的逻辑参考美团 -->
    <form action="{{{ action('ProjectController@getIndex') }}}">
        <div class="search-bar am-g">
            <div class="ad-left am-u-sm-3">
                <div style="text-align:center">
                    <h1 style="font-weight:bold; font-size:35px; color:#008e59">点投</h1>
                </div>

            </div>
            <div class="am-u-sm-6">
                <div class="am-input-group">
                  <input type="text" name="w" value="{{{$params['p_w']}}}" class="am-form-field" placeholder="搜索你感兴趣的项目">
                  <!--<input type="text" name="w" value="{{{$params['p_w'] == '_' ? '':$params['p_w']}}}" class="am-form-field" placeholder="搜索你感兴趣的项目">-->

                  <span class="am-input-group-btn">
                    <button class="am-btn am-btn-success" type="submit">点投一下</button>
                  </span>
                </div>
                <div class="search-hot-words">
                    <ul>
                        <li><a href="{{{ action('ProjectController@getIndex') }}}?w=北京烤鸭店">北京烤鸭店</a></li>
                        <li><a href="{{{ action('ProjectController@getIndex') }}}?w=牛排">牛排</a></li>
                        <li><a href="{{{ action('ProjectController@getIndex') }}}?w=烧烤">烧烤</a></li>
                        <li><a href="{{{ action('ProjectController@getIndex') }}}?w=教育">教育</a></li>
                        <li><a href="{{{ action('ProjectController@getIndex') }}}?w=蛋糕">蛋糕</a></li>

                    </ul>
                </div>

            </div>
            <div class="ad-right am-u-sm-3">

            </div>

        </div>

        <hr/>
        <div id="filter" class="am-g">
            <div class="am-u-sm-12">
                <?php
                    $params['p_industry'] = $params['p_industry'] == null ? 'all' : $params['p_industry'];
                    $params['p_state'] = $params['p_state'] == null ? 'all' : $params['p_state'];
                ?>
                <div>
                    <div class="cate-tag-name">行业分类：</div>
                    <ul>
                        <?php $p = $params;?>
                        <li @if(!in_array($params['p_industry'], array_pluck($cates['industry_list'], 'industry_code'))) class="active" @endif><a href="{{{action('ProjectController@getIndex', array_set($p, 'p_industry', 'all'))}}}">全部</a></li>
                        @foreach($cates['industry_list'] as $i)

                            <li @if($params['p_industry'] == $i['industry_code']) class="active" @endif><a href="{{{action('ProjectController@getIndex', array_set($p, 'p_industry', $i['industry_code']))}}}">{{{$i['industry_name']}}}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <div class="cate-tag-name">融资状态：</div>
                    <ul>
                        <?php $p = $params; ?>
                        <li @if(!in_array($params['p_state'], array_pluck($cates['state_list'], 'state_code'))) class="active" @endif><a href="{{{action('ProjectController@getIndex', array_set($p, 'p_state', 'all'))}}}">全部</a></li>
                        @foreach($cates['state_list'] as $i)
                            <li @if($params['p_state'] == $i['state_code']) class="active" @endif><a href="{{{action('ProjectController@getIndex', array_set($p, 'p_state', $i['state_code']))}}}">{{{$i['state_name']}}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="search-result am-g">
            <div class="am-u-sm-9">
                @foreach($plist as $p)
                <div class="am-u-sm-4 am-u-end">
                    <div class="am-thumbnail">
                      <a href="{{{action('ProjectController@getShow', array('id'=>$p->id))}}}"><img src="/{{{$p->project_cover}}}" alt=""/></a>
                      <div class="am-thumbnail-caption">
                        <h3>{{{$p->project_name}}}</h3>
                        <p>{{{$p->sub_title}}}</p>
                        <div class="am-progress am-progress-sm">
                            <div class="am-progress-bar" style="width:{{{($p->raised_bal * 100 / $p->raise_quota)}}}%"></div>
                        </div>
                        <div style="font-size:12px; overflow:hidden;">
                        <div style="clear:both"></div>
                        <span class="am-fl">{{{($p->raised_bal * 100 / $p->raise_quota)}}}%</span>
                        <span class="am-fr">剩余20天</span>
                        </div>
                      </div>
                    </div>
                </div>

                @endforeach

                <!--
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
                                        -->
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
    </form>

    <div class="detail">

    <div class="am-g">

    </div>

    </div>
</div>


@stop
@section('page_js')
<script>
$(function(){
	App.init(['project.index']);
});
</script>
@stop