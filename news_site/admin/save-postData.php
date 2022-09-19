<?php
include 'config.php';
	//echo "form is working";
if(isset($_FILES['imageUpload'])){
	$errors= array();
	$target=$_FILES['imageUpload']['name'];
	$file_size=$_FILES['imageUpload']['size'];
	$file_temp_name=$_FILES['imageUpload']['tmp_name'];
	$file_type=$_FILES['imageUpload']['type'];
	$file_text=explode('.',$file_name);
	// $extension= ["jpeg","png","jpg"];
	// if(in_array($file_text,$extension)===false){
	// 	$errors[]="The file extension should be jpeg, png and jpg format.";
	// }
	if($file_size>5212205){
		$errors[]="File Size too Big umpload less than 5 mb size.";
	}
	$new_name=time()."-".basename($target);//generating temparary name time name by this its help we cant over right image in database
	 $target="upload/".$new_name;
	 // echo $target;
	 // die();
	 //upload/1661060605-shahrukh.jpg
	if(empty(($errors)==true)){
		move_uploaded_file($file_temp_name,$target);
	}
	else{
		print_r($errors);
		die();
	}
}
	session_start();// when you want to pick session value you should be start session.
$post_title = mysqli_real_escape_string($conn,$_POST['post_title']);
$post_description=mysqli_real_escape_string($conn,$_POST['postdesc']);
$post_category=mysqli_real_escape_string($conn,$_POST['category']);
$date=date('d M, Y');
$author= $_SESSION['user_id'];

$sqlip="INSERT INTO post(title, description, category, post_date,author,post_img) VALUES('{$post_title}','{$post_description}','{$post_category}','{$date}',{$author},'{$new_name}');";

$sqlip.="UPDATE category SET post=post+1 WHERE category_id={$post_category}";

$queryip=mysqli_multi_query($conn, $sqlip);//this function for multiple query. 
if($queryip){
	header("Location: {$hostname}/admin/post.php");
}
else{
	echo "<div class='alert alert-danger'>Query is Failed</div>";
}
?>