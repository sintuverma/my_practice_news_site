<?php
if (isset($_POST['save'])){
  //echo "hello";
  include 'config.php';
  $category=mysqli_real_escape_string($conn,$_POST['cat']);

  //echo $category;
  //$post=1;
  $sqlc = "INSERT INTO `category`(`category_id`, `category_name`, `post`) VALUES ('','$category',0)";

  $resultc= mysqli_query($conn,$sqlc) or die("Query failed ho gayi dekh lo bhai");
  if($resultc>0){
    echo "category Successfully inserted";
  }
  else{
    echo "check your code";
  }

}
?>
<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
