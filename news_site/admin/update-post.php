
<?php include "header.php"; 
//checking and stop the author is same for update or not
if($_SESSION['role']==0){
    include 'config.php';
    $postu=$_GET['post_Id'];
    //echo $postu;
        $sqlch="SELECT author FROM post WHERE post.post_id= {$postu}";
                 $resultch=mysqli_query($conn,$sqlch) or die("Query is Failed.");//value assign in result who comings from database
                    if(mysqli_num_rows($resultch) > 0){
                        while ($rowup=mysqli_fetch_assoc($resultch)) {
                            //print_r($rowup);
                             if ($rowup['author']!=$_SESSION['user_id']) {
                                header("Location:{$hostname}/admin/post.php");
                             }
  }
}  
}
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php
    $postu=$_GET['post_Id'];
    //echo $postu;
    if(isset($_GET['post_Id'])){
        //echo "hello welcome update page";
        include 'config.php';
        $sqlup="SELECT post.post_id, post.title, post.description, post.post_date,post.post_img, category.category_name,post.category FROM post 
                    LEFT JOIN category on post.category= category.category_id
                    LEFT JOIN user ON post. author = user.user_id
                    WHERE post.post_id= {$postu}";
                    // echo $sqls;
                    // die();
                     $results=mysqli_query($conn,$sqlup) or die("Query is Failed.");//value assign in result who comings from database
                    if(mysqli_num_rows($results) > 0){
                        while ($rowup=mysqli_fetch_assoc($results)) {
                          //print_r($rowup); for testing data is coming or not.
                    

    
?>
        <!-- Form for show edit-->
        <form action="update-save-postData.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $rowup['post_id'];?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $rowup['title'];?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5"><?php echo $rowup['description'];?> </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <!-- <select class="form-control" name="category"> -->
                    
    <?php
                                   
            include 'config.php';
            $sqlcs="SELECT * FROM `category` ORDER BY category_name ASC; ";
            $querycs= mysqli_query($conn,$sqlcs) or die("Query is Failed");


            if(mysqli_num_rows($querycs) > 0){
                echo '<select  class="form-control" name="category">';
                while($rowcs = mysqli_fetch_assoc($querycs)){
                    if($rowup['category']== $rowcs['category_id']){
                        $select="selected";
                        //echo "helloo trrue".$row['sclass']."=>".$rowc['cid'];
                    }else{
                        $select="";
                        //echo "hello false".$row['sclass']."=>".$rowc['cid'];
                    }
                    
           echo"<option {$select} value='{$rowcs['category_id']}'>{$rowcs['category_name']}</option>";
       }
           echo"</select>";
       }
    ?>

                              
                </select>
                <input type="hidden" name="old_category" value="<?php echo $rowup['category'];?>">
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="newImage">
                <img  src="upload/<?php echo $rowup['post_img'];?>" height="200px" width="150px">
                 <input type="hidden" name="oldImage" value="<?php echo $rowup['post_img'];?>"> 
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php
            }//while loop bracket closed.
                }//if condition bracket closed
        ?>
    <?php } else{
        echo "<div class='alert alert-danger'> Record not found</div>";
    }?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
