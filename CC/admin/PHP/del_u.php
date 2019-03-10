<?php
header("Content-type:text/html;charset=utf-8");
if(isset($_POST["Submit"]) && $_POST["Submit"] == "确认删除"){
	$id = $_POST["id"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$email = $_POST['email'];
	$tel=$_POST['tel'];

	$con = new mysqli("localhost","root","","cinema");
	$sql1 = "DELETE FROM user WHERE id = '{$id}'";
	$sql2 = "INSERT INTO del_user (id,username,password,tel,email) values('$_POST[id]','$_POST[username]','$_POST[password]','$_POST[tel]','$_POST[email]')";
	$res1 = mysqli_query($con,$sql1);
	$res2 = mysqli_query($con,$sql2);
	if($res1&&$res2){
		echo "<script>alert('成功删除该用户！');</script>";
		header("Refresh:1;../demo/user_list.php") ;
	}
	else{
		echo "<script>alert('删除失败！');</script>";
		header("Refresh:1;../demo/user_list.php") ;
	}
}
else{
	echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
?>
