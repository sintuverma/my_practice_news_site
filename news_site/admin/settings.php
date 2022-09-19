<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Settings</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                include 'config.php';
                $sqlse="SELECT * FROM settings";
                $queryse=mysqli_query($conn,$sqlse);
                if(mysqli_num_rows($queryse)>0){
                  while($rowse=mysqli_fetch_assoc($queryse)){
                    //print_r($rowse);for testing
                 
                ?>
                  <!-- Form -->
                  <form  action="saveDataSetting.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="website_name">Website Name</label>
                          <input type="text" name="website_name" value="<?php echo $rowse['websiteName'];?>" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="logo">Website Logo</label>
                          <input type="file" name="logo">
                          <img src="images/<?php echo $rowse['logoImg'];?>">
                          <input type="hidden" name="old_logo" value="<?php echo $rowse['logoImg'];?>" >
                      </div>
                      <div class="form-group">
                          <label for="footer_desc">Footer Description</label>
                          <textarea name="footer_desc" class="form-control" rows="5" required><?php echo $rowse['footerDesc'];?></textarea>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  <?php
                  }
                }else{
                  echo' <h1> Record Not Found</h1>';
                }
                ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
