<?php
// echo"<pre>";
// print_r($_SERVER);//for server details
// echo"</pre>";  
// echo "<h1>". $_SERVER['PHP_SELF']."</h1>";// for getting path of current file
// echo "<h1>". basename($_SERVER['PHP_SELF'])."</h1>";// it will print /news_site/index.php->index.php only
include 'config.php';
$page=basename($_SERVER['PHP_SELF']);
switch ($page) {
     case "single.php":
    //     echo "Single Page";
    //     break;
        if(isset($_GET['id'])){
            $sqlt = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
            $queryt=mysqli_query($conn,$sqlt) or die("Query is Failed");
            if (mysqli_num_rows($queryt)) {
                $row = mysqli_fetch_assoc($queryt);
                $page_title  =$row['title'];
            } 
        }else{
            $page_title=" NO Record Found";
        }
        break;
        case 'author.php':
        if(isset($_GET['aid'])){
            $sqlt = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
            $queryt=mysqli_query($conn,$sqlt) or die("Query is Failed");
            if (mysqli_num_rows($queryt)) {
                $row = mysqli_fetch_assoc($queryt);
                $page_title  = " News ".$row['first_name']." ".$row['last_name'];
            } 
        }else{
            $page_title=" NO Record Found";
        }
        break;
    
    case 'category.php':
        if(isset($_GET['cid'])){
            $sqlt = "SELECT * FROM category WHERE category_id = {$_GET['cid']}";
            $queryt=mysqli_query($conn,$sqlt) or die("Query is Failed");
            if (mysqli_num_rows($queryt)) {
                $row = mysqli_fetch_assoc($queryt);
                $page_title  = " News ".$row['category_name'];
            } 
        }else{
            $page_title=" NO Record Found";
        }
        break;

    case 'search.php':
        if(isset($_GET['search']))
            $page_title= " Search News Result: ".$_GET['search'];
        break;
    default:
        $page_title= "News Site";
        break;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
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
                    echo'<a href=" index.php" id="logo"><img src="admin/images/'.$rowse['logoImg'].'">></a>';
                 }
             }
             }
                ?>
                <!-- <a href="index.php" id="logo"><img src="images/news.jpg"></a> -->
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                include 'config.php';

                
                //echo $cat_id;
                 $sql = "SELECT * FROM category WHERE post> 0";

                 $query=mysqli_query($conn,$sql) or die("Query Failed: Category");

                 if(mysqli_num_rows($query)>0){
                    $active="";
                ?>
                <ul class='menu'>
                    <li><a href='<?php echo $hostname;?>'>Home</a></li>
                    <?php
                    while ($row= mysqli_fetch_assoc($query)) {
                        if(isset($_GET['cid'])){
                    $cat_id= $_GET['cid'];
                    if($row['category_id']==$cat_id)
                       {
                        $active="active";
                       }
                       else{
                        $active="";
                       }
                }
                         
                       echo" <li><a class='{$active}' href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                    }
                    ?>
                </ul>
            <?php }?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
