<?php
header("Content-type:text/html;charset=utf-8");

//创建连接   
if($_POST){
	$con = mysqli_connect("localhost","root","","cinema");

//检测连接
	if (!$con){
		die('Could not connect: ' . mysqli_error());
		//连接服务器失败退出程序
	}
	$username = $_POST['username'];
	$password = $_POST['password'];

	$result ="SELECT * FROM user WHERE username = '$username' AND password ='$password'";

	$res = mysqli_query($con, $result);
	if (mysqli_num_rows($res)>0){
		echo "登录成功";
		header("Refresh:3;index_1.html") ;
	}
	else{
		echo "<script>alert ('账号或密码不正确'); history.go(-1);</script>";
	}
}
else{
	echo "连接创建失败！";
}	
?>