<?php include "header.php";
  if($_SESSION['role']=='0'){
    header("Location:{$hostname}/admin/post.php");
  }

  if(isset($_POST['save']))
  { 
    include 'config.php';
    // mysqli_real_escape_string(Connection variable, post or get form input name) ye mysql injection se secure karta hai hacking se bhi secure karta hai

    $ufname= mysqli_real_escape_string($conn,$_POST['fname']);
    $ulname= mysqli_real_escape_string($conn,$_POST['lname']);
    $uemail=mysqli_real_escape_string($conn,$_POST['email']);
    $upassword=mysqli_real_escape_string($conn,md5($_POST['password']));
    $ucpassword=mysqli_real_escape_string($conn,md5($_POST['cpassword']));
    $urole=mysqli_real_escape_string($conn,$_POST['role']);

   // echo extract($_POST);// ye function form ki input field numbers show karta hai. 
     // $formData=[$ufname,$ulname,$uemail,$upassword,$ucpassword,$urole];
     // echo "<pre>";
     // print_r($formData);
     // echo "</pre>";

    $sqle ="SELECT * FROM user where email='$uemail'";//fetching given email in form registration
    $resulte = mysqli_query($conn, $sqle);//passing query and connection
    $row=mysqli_num_rows($resulte);
    if($row>0)
    {
      echo "<h1 class='text-danger'> This email is already exist</h1>";
    }
    else 
    {
      if($upassword===$ucpassword)
      {
            $sqli="INSERT INTO `user`(`first_name`, `last_name`, `email`, `password`, `cpassword`, `role`) VALUES ('$ufname','$ulname','$uemail','{$upassword}','{$ucpassword}','{$urole}')";


           $resulti = mysqli_query($conn,$sqli);
           if($resulti){
            //echo "successfully insert data";
            header("Location: {$hostname}/admin/users.php");
       }

      }
      else{
        echo "confirm password is not matching Enter current password";
       
    }
      }
  }
?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>Email ID</label>
                          <input type="text" name="email" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>Confirm Password</label>
                          <input type="password" name="cpassword" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
