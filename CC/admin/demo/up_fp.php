<?php
$fp_id = $_GET{"fp_id"};
$db = mysqli_connect("localhost","root","","cinema");
$sql = "SELECT * FROM film_platoon WHERE fp_id='{$fp_id}'";
$r = $db->query($sql);
//mysqli_fetch_row() 函数从结果集中取得一行作为数字数组
$arr = $r->fetch_row();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title></title>
	<link rel="stylesheet" href="../frame/layui/css/layui.css">
	<link rel="stylesheet" href="../frame/static/css/style.css">
	<link rel="icon" href="../frame/static/image/code.png">
</head>
<body class="body">
	<div class="upload">   
		<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
			<legend>修改排片</legend>
		</fieldset>

		<form action="../PHP/ud_fp.php" method="post" class="layui-form"> 
			<div class="layui-form-item">
				<label class="layui-form-label">排片序号</label>
				<div class="layui-input-block">
					<input type="text" readonly="readonly" name="fp_id"class="layui-input" value="<?php echo $arr[0];?>"/>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">影片名</label>
				<div class="layui-input-block">
					<input type="text" name="m_name" class="layui-input" value="<?php echo $arr[1];?>"/>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">放映厅</label>
				<div class="layui-input-block">
					<input type="text" name="hall"   class="layui-input" value="<?php echo $arr[2];?>"/>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">放映日期</label>
				<div class="layui-input-block">
					<input type="text" name="film_date"  class="layui-input" value="<?php echo $arr[3];?>"/>
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">开场时间</label>
				<div class="layui-input-block">
					<input type="text" name="start_time"   class="layui-input" value="<?php echo $arr[4];?>"/>
				</div>
			</div>  

			<div class="layui-form-item layui-form-text">
				<label class="layui-form-label">结束时间</label>
				<div class="layui-input-block">
					<input type="text" name="over_time"   class="layui-input" value="<?php echo $arr[5];?>"/>
				</div>
			</div>


			<div class="layui-form-item">
				<input class="layui-btn"  lay-filter="demo2" type="submit" name="Submit" value="修改完毕"/>
			</div>  
		</form>
	</div>
	<script type="text/javascript" src="../frame/layui/layui.js"></script>
	<script type="text/javascript">
		// you code ...


	</script>
</body>
</html>