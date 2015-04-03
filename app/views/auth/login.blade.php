<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>登录 - 点投</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
    <link rel="stylesheet" href="/assets/css/app.css"/>
    <style>
        .login-header {
            height:80px;
            margin: 40px auto;
        }
        .login-header h1 {
            font-size: 200%;
            color: #333;

        }
        .header p {
            font-size: 14px;
        }

        .am-container{
            max-width: 1024px;
        }

        .login-form .am-input-group{
            margin-bottom:10px;
        }
        .login-form-wrapper{
            margin:30px auto;
        }
        .login-content{
            margin-bottom: 70px;
        }

    </style>
</head>
<body>

<div class="login-header am-container">
    <h1><span style="color:darkgreen; font-size:35px;">点投</span></h1>
</div>


<div class="login-content am-container am-g">
    <div class="login-banner am-u-md-8">
        <img width="480" height="370" src="https://s1.meituan.com/campaign/0.0.90/tuanpic/__41391723__1126465.jpg" alt="【城市/多城市/全国】专题名称">
    </div>
    <div class="am-u-sm-4">
        <div class="login-form-wrapper">
            账号登录
            <hr>

            <form action="/auth/login" method="post" class="login-form am-form">
                <div class="am-input-group">
                    <span class="am-input-group-label"><i class="am-icon-user"></i></span>
                    <input type="text" name="account" value="{{{Session::get('account')}}}" class="am-form-field" placeholder="手机号/邮箱">
                </div>

                <div class="am-input-group">
                    <span class="am-input-group-label"><i class="am-icon-lock"></i></span>
                    <input type="password" name="password" class="am-form-field" placeholder="密码">
                </div>

                <div style="margin-bottom: 10px;">
                    <input id="remember-me" type="checkbox" name="remember-me">
                    记住密码
                    <a href="#" style="float:right">忘记密码？</a>
                </div>

                <button type="submit" class="am-btn am-btn-success am-btn-block">登录</button>
                <p>还没有账号？<a href="{{{action('AuthController@getReg')}}}">免费注册</a></p>
            </form>
        </div>


        <hr>
        <span class="validate-tip am-text-danger"><?php echo Session::get('message'); ?></span>
    </div>

</div>
<div class="login-footer am-container">
    <hr>
    <p>© 2015 点投科技有限公司 www.diantou.com 京ICP证070791号 京公网安备11010502025545号</p>
</div>

</body>
</html>

