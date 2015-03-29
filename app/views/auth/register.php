<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Login Page | Amaze UI Example</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="format-detection" content="telephone=no">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="alternate icon" type="image/png" href="/assets/i/favicon.png">
    <link rel="stylesheet" href="/assets/css/amazeui.min.css"/>
    <style>
        .header {
            text-align: center;
        }
        .header h1 {
            font-size: 200%;
            color: #333;
            margin-top: 30px;
        }
        .header p {
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="am-g">
        <h1>点投</h1>
        <p>汇聚点滴力量，投入你我热情</p>
    </div>
    <hr />
</div>
<div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
        <ul class="am-nav am-nav-tabs am-nav-justify">
            <li class="am-active"><a href="#">个人账户</a></li>
            <li><a href="#">企业账户</a></li>
        </ul>

        <form action="/auth/register" method="post" class="am-form am-form-horizontal" style="margin-top:50px;">
            <div class="am-form-group">
                <label for="i-account" class="am-u-sm-2 am-form-label">手机号：</label>
                <div class="am-u-sm-8 am-u-end">
                    <input type="text" id="i-account" name="account" placeholder="" data-validate-message="" required >
                </div>
            </div>
            <div class="am-form-group">
                <label for="i-v-code" class="am-u-sm-2 am-form-label">验证码：</label>
                <div class="am-u-sm-2">
                    <input type="text" id="i-v-code"  name="v_code" value="" data-validate-message="输入短信中的验证码" required >
                </div>
                <div class="am-u-sm-8 am-u-end"><button type="button" class="v-code-btn am-btn am-btn-default">获取验证码</button></div>
            </div>
            <div class="am-form-group">
                <div class="am-u-sm-5 am-u-sm-offset-3">
                    <button type="submit" class="am-btn am-btn-success am-btn-block">下一步</button>
                </div>
            </div>
        </form>

        <hr>
        <p>© 2015 AllMobilize, Inc. Licensed under MIT license.</p>
    </div>
</div>
</body>
</html>
