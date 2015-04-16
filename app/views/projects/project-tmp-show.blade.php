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
    </table>
    <h1>投资</h1>
    <form action="{{{action('SubscriptionController@postSaveSub')}}}" method="post">
        <input type="hidden" name="project_id" value="{{{$project->id}}}">
        <input type="text" name="sub_amt" value="0">
        <button type="submit">确认</button>
    </form>
</body>
</html>
