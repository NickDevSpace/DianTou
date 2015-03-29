<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h3>点投网注册验证</h3>
		<div>
			亲爱的{{{$email}}}，感谢您注册点投网，请点击以下链接继续完成注册：<br/>{{ $verification_url }}<br/>
			您的Email将会作为您的账户名来登录点头网，链接有效时间为 {{ Config::get('auth.reminder.expire', 60) }} 分钟。<br/>
			<hr>
			点投网<br/>
			<a href="http://www.diantou.com">www.diantou.com</a>
		</div>
	</body>
</html>
