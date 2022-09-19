<?php
 include 'config.php';

 session_start();
     if(isset($_SESSION['email']))
     {//$ hostname variable is in config.php file
         header("Location:{$hostname}/admin/post.php");
     }
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
        <style type="text/css">
            span{
                position: absolute;
                right:60px;
                tranform: translate(0,-50%);
                top: 75%;
                cursor: pointer;
            }
        </style>
    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php  $_SERVER['PHP_SELF'];?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="email" class="form-control" placeholder="emal@xyz.com" >
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password"  name="password" class="form-control" placeholder="password"  id="password">
                                <span> <i id="eye" class='fa fa-eye'></i></span>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="Login" />
                        </form>

                        <!-- /Form  End -->
                        <?php
    
        if(isset($_POST['login'])){
            //echo "hello vinod working code";
    include 'config.php';
    if(empty($_POST['email']|| $_POST['password'])){
         echo"<div class='alert alert-danger'> Your Please enter your user name and password.</div>";
    }
 else{
    $userEmail=mysqli_real_escape_string($conn,$_POST['email']);
     $userPassword=md5($_POST['password']);
    $sqls="SELECT user_id ,role,first_name,last_name,email FROM user WHERE email='$userEmail' AND password='$userPassword'";
//echo $sqls;
//die();
     $result=mysqli_query($conn,$sqls) or die("Query is Failed");
     if(mysqli_num_rows($result)>0){
         //echo "data is coming and data is available there";
         while($row=mysqli_fetch_assoc($result)){

             //print_r($row);
        
              session_start();
                  $_SESSION['user_id']=$row['user_id'];
                  //echo $_SESSION['user_id'];
                  $_SESSION['firstName']=$row['first_name'];
                  $_SESSION['lastName']=$row['last_name']; 
                  //echo $_SESSION['firstName']." ".$_SESSION['lastName'];   
              
                $_SESSION['email']=$row['email'];
                $_SESSION['role']=$row['role'];//role column mean user type normal and admin
                echo $_SESSION['email']." ".$_SESSION['role']; 
                header("Location:{$hostname}/admin/post.php");
         }// second if condition bracket is closed.
     }// while loop bracket is closed.

     else{
         echo"<div class='alert alert-danger'> Your Password and email not found please enter your correct email and passwor</div>";
     }
 }
  } 
?>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>
