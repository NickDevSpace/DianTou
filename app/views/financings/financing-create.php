<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>

</head>
<body>
    <h1>新增融资</h1>
	<form action="/financings" method="post">
        <input type="hidden" name="project_id" value="<?php echo $project->project_no;?>">
        <div>
            <label>项目名称</label>
            <span><?php echo $project->project_name;?></span>
        </div>
        <div>
            <label>项目编号</label>
            <span><?php echo $project->project_no;?></span>
        </div>
        <div>
            <label>融资需求*</label>
            <input type="text" name="financial_needs">
        </div>
        <div>
            <label>出让股份*</label>
            <input type="text" name="transfer_ratio">
        </div>
        <div>
            <label>最小认购金额*</label>
            <input type="text" name="min_sub_amt">
        </div>
        <div>
            <label>融资天数*</label>
            <input type="text" name="financing_days">
        </div>
        <div>
            <label>资金用途*</label>
            <input type="text" name="capital_usage">
        </div>


        <input type="submit" value="申请">
	</form>
</body>
</html>
