<?php include "header.php";
  if($_SESSION['role']=='0'){
    header("Location:{$hostname}/admin/post.php");
  }
include 'config.php';

 if(isset($_POST['submit'])){
  $dcat_id=$_POST['cat_id'];
  $dcat_name=$_POST['cat_name'];

  //$cat_id  =mysqli_real_escape_string($conn,$_POST['cat_id']);
 // $cat_name=mysqli_real_escape_string($conn,$_POST['cat_name']);
  echo $dcat_name;
      // UPDATE `category` SET `category_name` = 'Health Area' WHERE `category`.`category_id` = 3;
       $updatec="UPDATE category SET category_name ='{$dcat_name}' WHERE category_id='$dcat_id'";
       $uquery=mysqli_query($conn,$updatec) or die("Query is Failed");
        if($uquery>0){
         //echo "Updated successfully";
           header("Location: {$hostname}/admin/category.php");
       }
       else{
         echo "Updated unsccessfully";
       }


}
?>

<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                  if(isset($_GET['id'])){
                      $id=$_GET['id'];
                      $sql1="SELECT category_id, category_name FROM category WHERE category_id='$id'";// we can use both style variable{$id}
                      $query=mysqli_query($conn,$sql1) or die("Query is Failed");
                      $row=mysqli_num_rows($query);
                      //echo $row ka output 1 ayega;
                        if($row>0){
                          //echo "value is 1 greater than 0";
                          while ($data=mysqli_fetch_assoc($query)) {
                            //print_r($data);
                          
                ?>
                  <form action="<?php htmlentities($_SERVER['PHP_SELF']);?>" method ="POST">

                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $data['category_id'];?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value=" <?php echo $data['category_name'];?>"  placeholder="" required>
                      <?php
                                                                    }//while loop bracket is closed
                                     }//row check if condition brackets is closed
                       // echo $id;
                                          }//first is isset function bracket close
                        ?>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
