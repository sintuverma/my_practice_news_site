<?php
 include "header.php";
  if($_SESSION['role']=='0'){
    header("Location:{$hostname}/admin/post.php");
  }
	include 'config.php';
	$get_id=$_GET['id'];
	$sqld= "DELETE FROM user WHERE user_id='$get_id'";
	$delete = mysqli_query($conn, $sqld) or die("Sql query is Failed");
	if($delete>0){
		//echo "Success full deleted";
		header("Location: {$hostname}/admin/users.php");
	}else{
		echo "<p style='color:red;margin:10px 0;'>Can\'t Delete the User Record";
	}
	mysql_close($conn);
?>