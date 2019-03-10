<?php
header("Content-type:text/html;charset=utf-8");
if(isset($_POST["Submit"]) && $_POST["Submit"] == "发送"){
	$name = $_POST["name"];
	$email = $_POST["email"];
	$phone = $_POST['phone'];
	$content = $_POST['content'];
	if($name == "" || $email == "" || $phone == "" || $content == ""){
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
		
		
		$sql_insert = "INSERT INTO contact (name,email,phone,content) values('$_POST[name]','$_POST[email]','$_POST[phone]','$_POST[content]')";
		$res_insert = mysqli_query($con,$sql_insert);

		if($res_insert){
			echo "<script>alert('提交成功！'); history.go(-1);</script>";
		}
		else{
			echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
		}
	}
}
else{
	echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
?>
