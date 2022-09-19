<?php
//echo "update post success fully";
include 'config.php';
if(empty($_FILES['newImage']['name'])){
	$new_name= $_POST['oldImage'];
}else{

$errors= array();
	$target=$_FILES['newImage']['name'];
	$file_size=$_FILES['newImage']['size'];
	$file_temp_name=$_FILES['newImage']['tmp_name'];
	$file_type=$_FILES['newImage']['type'];
	$file_text=explode('.',$target);
	// $extension= ["jpeg","png","jpg"];
	// if(in_array($file_text,$extension)===false){
	// 	$errors[]="The file extension should be jpeg, png and jpg format.";
	// }
	if($file_size>5212205){
		$errors[]="File Size too Big umpload less than 5 mb size.";
	}
		$new_name=time()."-".basename($target);
			// echo $new_name;
			// die();
	 $target="upload/".$new_name;

	if(empty(($errors)==true)){
		move_uploaded_file($file_temp_name,$target);
	}
	else{
		print_r($errors);
		die();
	}

}
$sqlup="UPDATE post SET `title`='{$_POST['post_title']}', `description`='{$_POST['postdesc']}',`category`='{$_POST['category']}',`post_img`='{$new_name}' WHERE `post_id`={$_POST['post_id']};";

if($_POST['old_category']!=$_POST['category']){
$sqlup.= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old_category']}; ";
$sqlup.= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST['category']} ;";
}

// echo $sqlup;
// die();

 $queryup=mysqli_multi_query($conn,$sqlup) or die("Query is Failed");
 if($queryup){
	echo "updated successfully";
	header("Location:{$hostname}/admin/post.php");
}
 else{
 	echo " updated not successfully";
 }
?>

