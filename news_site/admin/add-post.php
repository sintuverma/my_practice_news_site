<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Add New Post</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form -->
                  <form  action="save-postData.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="post_title">Title</label>
                          <input type="text" name="post_title" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1"> Description</label>
                          <textarea name="postdesc" class="form-control" rows="5"  required></textarea>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Category</label>
                          <select name="category" class="form-control">
                              <option  disabled> Select Category</option>
                              <?php
                                    include 'config.php';
                                    $sqlcs="SELECT * FROM `category` ORDER BY category_name ASC; ";
                                    $querycs=mysqli_query($conn,$sqlcs);
                                    $resultcs=mysqli_num_rows($querycs);//$resultc value 0 or 1 but $querycs value in array form
                                    if($resultcs>0){
                                      //echo "hello vinod";
                                       while($rowcs=mysqli_fetch_assoc($querycs)){
                                         //print_r($rowcs);
                                        echo "<option value='{$rowcs['category_id']}'> {$rowcs['category_name']}</option>";
                                       }
                                    }
                              ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="exampleInputPassword1">Post image</label>
                          <input type="file" name="imageUpload" required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
