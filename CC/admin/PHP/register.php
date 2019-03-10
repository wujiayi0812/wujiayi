<?php
header("Content-type:text/html;charset=utf-8");
if(isset($_POST["Submit"]) && $_POST["Submit"] == "注册"){
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST['email'];
	$tel=$_POST['tel'];
	if($username == "" || $password == "" || $email == "" || $tel == ""){
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
		$sql = "SELECT * FROM user WHERE username = '$_POST[username]'";	//SQL语句
		//执行SQL语句
		$result = mysqli_query($con,$sql);
		//统计执行结果影响的行数	
		$name = mysqli_num_rows($result);	
		if($name){	//如果已经存在该用户
			echo "<script>alert ('用户名已存在'); history.go(-1);</script>";
		}
		else{
			$sql_insert = "INSERT INTO user (username,password,email,tel) values('$_POST[username]','$_POST[password]','$_POST[email]','$_POST[tel]')";
			$res_insert = mysqli_query($con,$sql_insert);

			if($res_insert){
				echo "<script>alert('注册成功！'); history.go(-1);</script>";
			}
			else{
				echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
			}
		}

	}
}
else{
	echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
?>
