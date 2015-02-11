<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>首页 | 点投</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <link rel="alternate icon" type="image/png" href="{{{asset('assets/i/favicon.png')}}}">
    <link rel="stylesheet" href="{{{asset('assets/css/amazeui.min.css')}}}"/>
    @yield('head')
</head>
<body>

<header class="am-topbar am-topbar-fixed-top">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="#">点投</a>
        </h1>


        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-secondary am-show-sm-only"
                data-am-collapse="{target: '#collapse-head'}"><span class="am-sr-only">导航切换</span> <span
                class="am-icon-bars"></span></button>

        <div class="am-collapse am-topbar-collapse" id="collapse-head">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li class="am-active"><a href="/">首页</a></li>
                <li><a href="#">浏览项目</a></li>
                <li><a href="/projects/create">发起项目</a></li>
            </ul>

            <?php if(Auth::check()): ?>
            <div class="am-topbar-right">
                <li class="am-dropdown" data-am-dropdown>
                    <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                        <?php echo Auth::user()->mobile; ?> <span class="am-icon-caret-down"></span>
                    </a>
                    <ul class="am-dropdown-content">
                        <li class="am-dropdown-header">标题</li>
                        <li><a href="#">我的项目</a></li>
                        <li><a href="/auth/logout">注销</a></li>
                    </ul>
                </li>
            </div>
            <?php else: ?>
            <div class="am-topbar-right">
                <button class="am-btn am-btn-secondary am-topbar-btn am-btn-sm" id="register-btn"><span class="am-icon-pencil"></span> 注册</button>
            </div>

            <div class="am-topbar-right">
                <button class="am-btn am-btn-primary am-topbar-btn am-btn-sm" id="login-btn"><span class="am-icon-user"></span> 登录</button>
            </div>
            <?php endif;?>
        </div>
    </div>
</header>

@yield('content')


<footer class="footer">
    <p>© 2014 <a href="http://www.yunshipei.com" target="_blank">AllMobilize, Inc.</a> Licensed under <a
            href="http://opensource.org/licenses/MIT" target="_blank">MIT license</a>. by the AmazeUI Team.</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/polyfill/rem.min.js"></script>
<script src="assets/js/polyfill/respond.min.js"></script>
<script src="assets/js/amazeui.legacy.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="{{{asset('assets/js/jquery.min.js')}}}"></script>
<script src="{{{asset('assets/js/amazeui.min.js')}}}"></script>
<!--<![endif]-->

<script src="{{{asset('assets/js/app.js')}}}"></script>
</body>
</html>