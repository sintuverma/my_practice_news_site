<?php include "header.php";
  if($_SESSION['role']=='0'){
    header("Location:{$hostname}/admin/post.php");
  }
include 'config.php';
if(isset($_GET['id'])){
	$cat_id=$_GET['id'];
	//echo "{$cat_id}.'$cat_id'";both will print same value
	  //DELETE FROM`category` WHERE category_id=1;
	 $deletec= "DELETE FROM category WHERE category_id='$cat_id'";
	 $resultdc=mysqli_query($conn, $deletec)or die("Query is Failed");
	 if($resultdc>0){
	 	//echo "success fully deleted";
	 	?>
	 	<script type="text/javascript">alert("Category is Successfully Deleted");</script>
	 	<?php header("Location: {$hostname}/admin/category.php");
	 }else{
	 	echo"Not Deleted Successfully.'<a href=''> G0 back</a>'";
	 }
	
}
?>