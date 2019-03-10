<?php
header("Content-type:text/html;charset=utf-8");
if(isset($_POST["Submit"]) && $_POST["Submit"] == "提交评论"){
	$username = $_POST["username"];
	$movie_name = $_POST["movie_name"];
	date_default_timezone_set('地区');
	$time = time(); 
	$comment=$_POST['comment'];
	if($username == "" || $movie_name == "" || $comment == ""){
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
		$sql_insert = "INSERT INTO comment (username,movie_name,comment) values('$_POST[username]','$_POST[movie_name]','$_POST[comment]')";
		$res_insert = mysqli_query($con,$sql_insert);
			//$name_insert = mysql_num_rows($res_insert);
		if($res_insert){
			echo "<script>alert('提交成功！');</script>";
			header("Refresh:1;../index/js/single.php") ;
		}
		else{
			echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
		}
	}
}
else{
	echo "<script>alert('提交失败！'); history.go(-1);</script>";
}
?>
