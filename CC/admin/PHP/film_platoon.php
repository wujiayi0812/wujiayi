<?php
header("Content-type:text/html;charset=utf-8");
if(isset($_POST["Submit"]) && $_POST["Submit"] == "确定排片"){
	$movie_name = $_POST["m_name"];
	$m_name = $_POST["m_name"];
	$hall = $_POST['hall'];
	$film_date=$_POST['film_date'];
	$start_time=$_POST['start_time'];
	$over_time=$_POST['over_time'];
	if($movie_name == "" || $hall == "" || $film_date == "" || $start_time == "" || $over_time == "" ){
		echo "<script>alert('排片信息不完整！'); history.go(-1);</script>";
	}
	else{//连接数据库
		$con = mysqli_connect("localhost","root","","cinema");			
		//连接服务器失败退出程序
		if (!$con){
			die('Could not connect: ' . mysqli_error());

		}
		//设定字符集
		mysqli_query($con,"SET NAMES 'UTF8'");	
		
		$mn ="SELECT * FROM movie WHERE movie_name = '$m_name' ";
		$sql = "SELECT * FROM film_platoon WHERE (hall,film_date,start_time) = '$hall', '$film_date', 'start_time'";
		
		$res_mn= mysqli_query($con,$mn);
		$result= mysqli_query($con,$sql);
		
		$x = mysqli_num_rows($res_mn);
		$y = mysqli_num_rows($result);	
		
		if (!$x) {
			echo "<script>alert ('该影片未上传，无法操作！'); history.go(-1);</script>";
		}
		elseif($y){
			echo "<script>alert ('该时段已安排影片'); history.go(-1);</script>";
		}
		else{
			$sql_insert = "INSERT INTO film_platoon (m_name,hall,film_date,start_time,over_time) values('$_POST[m_name]','$_POST[hall]','$_POST[film_date]','$_POST[start_time]','$_POST[over_time]')";
			$res_insert = mysqli_query($con,$sql_insert);
			if($res_insert){
				echo "<script>alert('排片成功！'); history.go(-1);</script>";
			}
			else{
				echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
			}
		}

	}
}
else{
	echo "<script>alert('排片失败！'); history.go(-1);</script>";
}
?>
