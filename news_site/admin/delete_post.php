<?php
	//echo "hello";
	include "config.php";
	$postId=$_GET['post_Id'];
	$catId=$_GET['cat_Id'];
		// Deletin pictures from folder by unlink function
		$sql1= "SELECT * FROM post WHERE post_id= {$postId}";
		$query1= mysqli_query($conn,$sql1);
		$row=mysqli_fetch_assoc($query1) or die("query is failed");
		
		unlink("upload/".$row['post_img']);


// deleting and updating data from post and category rable

	$sql = "DELETE FROM post WHERE post_id = {$postId};";//using semicolum inside double qotes and outside too it will separate the query
	// we concating two queries

	$sql.= "UPDATE category SET post = post - 1 WHERE category_id = {$catId} ";
    //echo $sql; testing query value showed
	 $query=mysqli_multi_query($conn, $sql) or die("Query is Failed");
	 if($query){
	 	header("location: {$hostname}/admin/post.php");
	}
	else{
		echo "Query is failed";
	}
?>