<?php
 include "header.php";
  if($_SESSION['role']=='0'){
    header("Location:{$hostname}/admin/post.php");
  }

  include 'config.php';
  if(isset($_POST['submit'])){
    $uuid=mysqli_real_escape_string($conn, $_POST['user_id']);
    //echo $uuid;
    $uufname=mysqli_real_escape_string($conn, $_POST['f_name']);
    $uulname=mysqli_real_escape_string($conn, $_POST['l_name']);
    $uuemail=mysqli_real_escape_string($conn, $_POST['email']);
    $uurole=mysqli_real_escape_string($conn, $_POST['role']);
    $usql="UPDATE user SET first_name='{$uufname}',last_name='$uulname',email='{$uuemail}', role='{$uurole}' WHERE user_id='{$uuid}'";
    $update =mysqli_query($conn, $usql) or die("Query is Failed");
    echo $update;

    //echo "<p style='color:red'>$update</p>";
      if($update>0)
      {
        header("Location: {$hostname}/admin/users.php");
      }
  }
?>


  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                <?php
                    //include 'config.php'; this file already include above
                    $user_id =$_GET['id'];
                    //echo $user_id;
                    $sqlu="SELECT * FROM user WHERE user_id='$user_id'";//we can use {$user_id}too;
                    $resultu=mysqli_query($conn,$sqlu);
                    if(mysqli_num_rows($resultu)>0){
                        while($rowu=mysqli_fetch_assoc($resultu)){
                          //print_r($rowu);
                ?>
                  <!-- Form Start -->
                  <form  action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="user_id"  class="form-control" value="<?php echo $rowu['user_id'];?>" placeholder="" >
                      </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php echo $rowu['first_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php echo $rowu['last_name'];?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Email ID</label>
                          <input type="text" name="email" class="form-control" value="<?php echo $rowu['email'];?>" placeholder="" required>
                      </div>
                      <!-- <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div> -->
                      
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $rowu['role']; ?>">

                               <?php
                              
                                echo $row['role'];
                               if($rowu['role']==0)
                               {
                                 echo "<option value='0' selected>normal User</option>
                                       <option value='1'>Admin</option>";
                               }
                                else
                                   {
                                     echo  "<option value='0'>normal User</option>
                                            <option value='1' selected>Admin</option>";
                                   }
                              ?>


                              
                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                      <?php
                    
                  }   //while loop bracket is cloased
                }     //if condition bracket is closed.
                      ?>
                  </form>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
