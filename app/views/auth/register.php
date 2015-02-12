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
        <h1>点 TOU</h1>
        <p>汇聚点滴力量，投入你我热情</p>
    </div>
    <hr />
</div>
<div class="am-g">
    <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
        <h3>注册个账号</h3>
        <hr>

        <form action="/auth/register" method="post" class="am-form">
            <label for="mobile">手机:</label>
            <input type="text" name="mobile" id="mobile" value="">
            <br>
            <label for="password">密码:</label>
            <input type="password" name="password" id="password" value="">
            <br>
            <label for="password_confirm">重复密码:</label>
            <input type="password" name="password_confirm" id="password_confirm" value="">
            <br>
            <div>
                <label>省份</label>
                <?php echo Form::select('province_code', $province_select);?>
            </div>
            <br>
            <div>
                <label>城市</label>
                <?php echo Form::select('city_code', $city_select);?>
            </div>
            <br>
            <br />
            <div class="am-cf">
                <input type="submit" name="" value="注 册" class="am-btn am-btn-primary am-btn-sm am-fl">
            </div>
        </form>
        <?php echo $errors->first('mobile'); ?>
        <?php echo $errors->first('password'); ?>
        <?php echo $errors->first('password-confirm'); ?>
        <?php echo $errors->first('province_code'); ?>
        <?php echo $errors->first('city_code'); ?>


        <hr>
        <p>© 2015 AllMobilize, Inc. Licensed under MIT license.</p>
    </div>
</div>
</body>
</html>
