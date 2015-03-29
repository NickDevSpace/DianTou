<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>管理中心 - 点投</title>
  <meta name="description" content="这是一个 table 页面">
  <meta name="keywords" content="table">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="alternate icon" type="image/png" href="{{{asset('assets/i/favicon.png')}}}">
  <link rel="apple-touch-icon-precomposed" href="/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="{{{asset('assets/css/amazeui.min.css')}}}"/>
  <link rel="stylesheet" href="{{{asset('assets/css/admin.css')}}}"/>

</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar admin-header">
  <div class="am-topbar-brand">
    <strong>点投</strong> <small>后台管理</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="#"><span class="am-icon-user"></span> 资料</a></li>
          <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
          <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
  <div class="admin-sidebar">
    <ul class="am-list admin-sidebar-list">
      <li><a href="{{{action('AdminIndexController@getIndex')}}}"><span class="am-icon-home"></span> 首页</a></li>
      <li class="admin-parent">
          <a class="am-cf" data-am-collapse="{target: '#nav-check'}"><span class="am-icon-legal"></span> 审核中心 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
          <ul class="am-list am-collapse admin-sidebar-sub am-in" id="nav-check">
            <li><a href="{{{action('AdminAuditController@getUserCertify')}}}" class="am-cf"><span class="am-icon-credit-card"></span> 实名认证审核<span class="am-badge am-badge-secondary am-margin-right am-fr">24</span></a></li>
            <li><a href="#"><span class="am-icon-puzzle-piece"></span> 项目审核<span class="am-badge am-badge-secondary am-margin-right am-fr">24</span></a></li>
          </ul>
      </li>
      <li class="admin-parent">
        <a class="am-cf" data-am-collapse="{target: '#nav-dashboard'}"><span class="am-icon-pie-chart"></span> 统计中心 <span class="am-icon-angle-right am-fr am-margin-right"></span></a>
        <ul class="am-list am-collapse admin-sidebar-sub " id="nav-dashboard">
          <li><a href="#" class="am-cf"><span class="am-icon-dashboard"></span> 仪表盘<span class="am-icon-star am-fr am-margin-right admin-icon-yellow"></span></a></li>
          <li><a href="#"><span class="am-icon-line-chart"></span> 报表1</a></li>
          <li><a href="#"><span class="am-icon-pie-chart"></span> 报表2</a></li>
        </ul>
      </li>
      <li><a href="{{{action('AdminUserController@getIndex')}}}"><span class="am-icon-user"></span> 用户管理</a></li>
      <li><a href="admin-table.html"><span class="am-icon-archive"></span> 项目管理</a></li>
      <li><a href="admin-table.html"><span class="am-icon-file"></span> 页面管理</a></li>

      <li><a href="{{{action('AdminSystemMessageController@getIndex')}}}"><span class="am-icon-envelope"></span> 系统消息管理</a></li>
      <li><a href="admin-table.html"><span class="am-icon-wrench"></span> 系统参数管理</a></li>

    </ul>
    <div class="am-panel am-panel-default admin-sidebar-panel">
        <div class="am-panel-bd">
          <p><span class="am-icon-bookmark"></span> 公告</p>
          <p>时光静好，与君语；细水流年，与君同。—— Amaze UI</p>
        </div>
    </div>
  </div>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">

    @if(Session::get('message'))
    <div class="am-alert" data-am-alert>
      <button type="button" class="am-close">&times;</button>
      <span style="display:block; text-align:center" class="alert-message">{{{Session::get('message')}}}</span>
    </div>
    @endif
    @yield('admin-content')

  </div>
  <!-- content end -->
</div>

<footer>
  <hr>
  <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="{{{asset('assets/js/polyfill/rem.min.js')}}}"></script>
<script src="{{{asset('assets/js/polyfill/respond.min.js')}}}"></script>
<script src="{{{asset('assets/js/amazeui.legacy.js')}}}"></script>
<![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{{asset('assets/js/jquery.min.js')}}}"></script>
<script src="{{{asset('assets/js/amazeui.min.js')}}}"></script>
<!--<![endif]-->
<script src="{{{asset('assets/js/admin.js')}}}"></script>
@yield('vendor_js')
@yield('page_js')
</body>
</html>
