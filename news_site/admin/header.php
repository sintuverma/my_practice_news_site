<?php
include 'config.php';

session_start();
    if(!isset($_SESSION['email']))
    {//$ hostname variable is in config.php file
        header("Location:{$hostname}/admin/");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                                        <?php
                include 'config.php';
                $sqlse="SELECT * FROM settings";
                $queryse=mysqli_query($conn,$sqlse);
                if(mysqli_num_rows($queryse)>0){
                  while($rowse=mysqli_fetch_assoc($queryse)){
                    //print_r($rowse);
                    if($rowse['logoImg']==""){
                        echo'<a href="index.php"><h1>'.$rowse['websiteName'].'</h1></a>';
                    
                 }else{
                    echo'<a href=" index.php" id="logo"><img src="images/'.$rowse['logoImg'].'">></a>';
                 }
             }
             }
                ?>
                        <!-- <a href="post.php"><img class="logo" src="images/news.jpg"></a> -->
                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-md-3">
                        <a href="logout.php" class="admin-logout" ><?php echo "Hello ". $_SESSION['firstName']." ". $_SESSION['lastName']." "; ?>logout</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <ul class="admin-menu">
                            <li>
                                <a href="post.php">Post</a>
                            </li>
                            <?php if($_SESSION['role']==1){?>
                            <li>
                                <a href="category.php">Category</a>
                            </li>
                            <li>
                                <a href="users.php">Users</a>
                            </li>
                            <li>
                                <a href="settings.php">Settings</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Menu Bar -->
