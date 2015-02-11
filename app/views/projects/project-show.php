<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>

</head>
<body>
    <h1>项目 <?php echo $project->project_name; ?></h1>
    <table>
        <tr>
            <td>项目名称</td>
            <td><?php echo $project->project_name; ?></td>
        </tr>
        <tr>
            <td>项目编号</td>
            <td><?php echo $project->project_no; ?></td>
        </tr>
        <tr>
            <td>项目封面</td>
            <td><?php echo $project->cover_img; ?></td>
        </tr>
        <tr>
            <td>项目亮点</td>
            <td><?php echo $project->big_point; ?></td>
        </tr>
        <tr>
            <td>所处阶段</td>
            <td><?php echo $project->project_stage; ?></td>
        </tr>
        <tr>
            <td>团队人数</td>
            <td><?php echo $project->team_size; ?></td>
        </tr>
        <tr>
            <td>省份</td>
            <td><?php echo $project->province->province_name; ?></td>
        </tr>
        <tr>
            <td>城市</td>
            <td><?php echo $project->city->city_name; ?></td>
        </tr>

    </table>
</body>
</html>
