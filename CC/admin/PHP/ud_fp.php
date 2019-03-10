<?php
header("Content-type:text/html;charset=utf-8");
$fp_id = $_POST["fp_id"];
$m_name = $_POST["m_name"];
$hall = $_POST["hall"];
$film_date = $_POST['film_date'];
$start_time=$_POST['start_time'];
$over_time=$_POST['over_time'];
$con = new mysqli("localhost","root","","cinema");
$sql = "UPDATE film_platoon set m_name = '{$m_name}',
hall='{$hall}',
film_date='{$film_date}',
start_time='{$start_time}',
over_time='{$over_time}' WHERE fp_id='{$fp_id}'";
//看一下是不是传递过来的id值；
$sql1 = "SELECT * FROM film_platoon where (hall,film_date ,start_time)= ('$_POST[hall]','$_POST[film_date]','$_POST[start_time]')";
$result1 = mysqli_query($con,$sql1);
$name = mysqli_num_rows($result1);
if ($name) {
	echo "<script>alert('该时段已排片！'); history.go(-1);</script>";
	}
else{
	if($con->query($sql)){
		echo "<script>alert('修改成功！');</script>";
		header("Refresh:1;../demo/fp_list.php") ;
	}
	else
		echo "<script>alert('修改失败！'); history.go(-1);</script>";
}

?>
