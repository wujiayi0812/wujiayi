<?php
header("Content-type:text/html;charset=utf-8");
if(isset($_POST["Submit"]) && $_POST["Submit"] == "添加"){
	$name = $_POST["name"];
	$password = $_POST["password"];
	if($name == "" || $password == ""){
		echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
	}
	else{//连接数据库
		$con = mysqli_connect("localhost","root","","cinema");			
		//连接服务器失败退出程序
		if (!$con){
			die('Could not connect: ' . mysqli_error());
		}
		//设定字符集
		mysqli_query("SET NAMES 'UTF8'",$con);
		$sql = "SELECT * FROM admin WHERE name = '$_POST[name]'";	//SQL语句
		//执行SQL语句
		$result = mysqli_query($con,$sql);
		//统计执行结果影响的行数	
		$name = mysqli_num_rows($result);	
		if($name){	//如果已经存在
			echo "<script>alert ('管理员已存在'); history.go(-1);</script>";
		}
		else{
			$sql_insert = "INSERT INTO admin (name,password) values('$_POST[name]','$_POST[password]')";
			$res_insert = mysqli_query($con,$sql_insert);

			if($res_insert){
				echo "<script>alert('添加成功！'); history.go(-1);</script>";
			}
			else{
				echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
			}
		}

	}
}
else{
	echo "<script>alert('添加失败！'); history.go(-1);</script>";
}
?>
