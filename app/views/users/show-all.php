<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>
	<style>

		body {
			margin:0;
			font-family:'Lato', sans-serif;
			text-align:center;
			color: #999;
		}

		.welcome {
			width: 300px;
			height: 200px;
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -150px;
			margin-top: -100px;
		}

		a, a:visited {
			text-decoration:none;
		}

		h1 {
			font-size: 32px;
			margin: 16px 0 0 0;
		}
	</style>
</head>
<body>
	<div class="welcome">
		<h1>UserAll.</h1>
        <table>
            <tr>
                <td>用户Id</td>
                <td>邮箱</td>
                <td>手机</td>
                <td>省份</td>
                <td>城市</td>
            </tr>

        </table>
        <?php foreach($users as $u): ?>
            <tr>
                <td><?php echo $u->id ?></td>
                <td><?php echo $u->email ?></td>
                <td><?php echo $u->mobile ?></td>
                <td><?php echo $u->province_code ?></td>
                <td><?php echo $u->city_code ?></td>
            </tr>
        <?php endforeach; ?>
	</div>
</body>
</html>
