<?php
//echo "update post success fully";
include 'config.php';
if(empty($_FILES['logo']['name'])){
    $file_name= $_POST['old_logo'];
}else{

$errors= array();
    $file_name=$_FILES['logo']['name'];
    $file_size=$_FILES['logo']['size'];
    $file_temp_name=$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];
    $file_text=end(explode('.',$file_name));
     $extensions= ["jpeg","jpg","png"];
     if(in_array($file_text,$extensions)===false){
      $errors[]="The file extension should be jpeg, png and jpg format.";
     }
    if($file_size>2097152){
        $errors[]="File Size too Big umpload less than 5 mb size.";
    }

    if(empty(($errors)==true)){
        move_uploaded_file($file_temp_name, "images/".$file_name);
    }
    else{
        print_r($errors);
        die();
    }
}

$sqlup="UPDATE settings SET `websiteName`='{$_POST['website_name']}', `logoImg`='{$file_name}',`footerDesc`='{$_POST['footer_desc']}'";
 //echo $sqlup;
// die();
 $queryup=mysqli_query($conn,$sqlup) or die("Query is Failed");
  if($queryup){
     echo "updated successfully";
    header("Location:{$hostname}/admin/settings.php");
 }
  else{
     echo " updated not successfully";
 }
?>
