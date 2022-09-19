<?php
echo "this is login page";

if(isset($_POST['login'])){
	include 'config.php';
	$userEmail=mysqli_real_escape_string($conn,$_POST['email']);
	$userPassword=md5($_POST['password']);
	$sqls="SELECT user_id, email, role FROM user where email={$userEmail} AND password={$userPassword} ";
	$reslult=mysqli_query($conn,$sqls) or die("Query is Failed");
	if(mysqli_num_rows($reslult)>0){
		echo "data is coming";
	}else{
		echo "data is not coming";
	}

	
}
?>