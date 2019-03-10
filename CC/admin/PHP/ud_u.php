<?php
header("Content-type:text/html;charset=utf-8");
$id = $_POST["id"];
$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST['email'];
$tel=$_POST['tel'];
$con = new mysqli("localhost","root","","cinema");
$sql = "UPDATE user set username = '{$username}',
password='{$password}',
email='{$email}',
tel='{$tel}' WHERE id='{$id}'";
//看一下是不是传递过来的id值；
$sql1 = "SELECT * FROM user where username= '$_POST[username]'";
$result1 = mysqli_query($con,$sql1);
$name = mysqli_num_rows($result1);
if ($name) {
	echo "<script>alert('用户名已被占用！'); history.go(-1);</script>";
	}
else{
	if($con->query($sql)){
		echo "<script>alert('修改成功！');</script>";
		header("Refresh:1;../demo/user_list.php") ;
	}
	else
		echo "<script>alert('修改失败！'); history.go(-1);</script>";
}

?>
