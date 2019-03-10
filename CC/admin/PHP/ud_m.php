<?php
header("Content-type:text/html;charset=utf-8");
$movie_id = $_POST["movie_id"];
$movie_name = $_POST["movie_name"];
$star = $_POST["star"];
$movie_type = $_POST['movie_type'];
$pic=$_POST['pic'];
$movie_intro=$_POST['movie_intro'];
$con = new mysqli("localhost","root","","cinema");
$sql = "UPDATE movie set movie_name = '{$movie_name}',
star='{$star}',
movie_type='{$movie_type}',
pic='{$pic}',
movie_intro='{$movie_intro}' WHERE movie_id='{$movie_id}'";


if($con->query($sql)){
	echo "<script>alert('修改成功！');</script>";
	header("Refresh:1;../demo/movie.php") ;
}
else
	echo "<script>alert('修改失败！'); history.go(-1);</script>";


?>
