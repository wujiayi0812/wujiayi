<?php
header("Content-type:text/html;charset=utf-8");
if(isset($_POST["Submit"]) && $_POST["Submit"] == "点击上传"){
	$con = mysqli_connect("localhost","root","","cinema");	
	$pic_before = $_FILES['pic']['name'];
	$pic = "../admin/PHP/upload/".$pic_before;
	$movie_name = $_POST["movie_name"];
	$star = $_POST['star'];
	$movie_type=$_POST['movie_type'];
	$movie_intro=$_POST['movie_intro'];
	if($pic == "" || $movie_name == "" || $star == "" || $movie_type == "" || $movie_intro == ""){
		echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
	}
	else{//连接数据库
		$con = mysqli_connect("localhost","root","","cinema");			
		//连接服务器失败退出程序
		if (!$con){
			die('Could not connect: ' . mysqli_error());

		}
		//设定字符集
		// mysqli_query("SET NAMES 'UTF8'",$con);	
		$sql = "SELECT * FROM movie where movie_name = '$_POST[movie_name]'";	//SQL语句
		//执行SQL语句
		$result = mysqli_query($con,$sql);
		//统计执行结果影响的行数	
		$name = mysqli_num_rows($result);	
		if($name){	//如果已经存在该电影
			echo "<script>alert ('该电影已存在'); history.go(-1);</script>";
		}
		else{
			$sql_insert = "INSERT INTO movie (pic,movie_name,star,movie_type,movie_intro) values('".$pic."','$_POST[movie_name]','$_POST[star]','$_POST[movie_type]','$_POST[movie_intro]')";
			move_uploaded_file($_FILES["pic"]["tmp_name"], "upload/" . $_FILES["pic"]["name"]);
			$res_insert = mysqli_query($con,$sql_insert);
			//$name_insert = mysql_num_rows($res_insert);
			if($res_insert){
				echo "<script>alert('上传成功！');</script>";
				header("Refresh:3;../demo/upload.html") ;
			}
			else{
				echo mysqli_error();
			}
		}

	}
}
else{
	echo "<script>alert('上传失败！'); history.go(-1);</script>";
}
?>
