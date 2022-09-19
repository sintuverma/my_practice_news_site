<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                        <?php
                        $news_post_det_id = $_GET['id'];
                    include 'config.php';//connection configuration file

                    $sqls="SELECT post.post_id, post.title, post.description, post.post_date,post_img, category.category_name,user.first_name,user.last_name,post.category, post.author FROM post 
                    LEFT JOIN category on post.category= category.category_id
                    LEFT JOIN user ON post. author = user.user_id
                    WHERE post.post_id={$news_post_det_id} ";
                    //echo $sqls; checking query output is wrong or okay
                    //die();
                    $query=mysqli_query($conn,$sqls) or die("Query is Failed.");//value assign in result who comings from database
                    if(mysqli_num_rows($query) > 0){
                    while ($row=mysqli_fetch_assoc($query)) {
                    //print_r($row);
             
                     ?>       
                        <div class="post-content single-post">
                            <h3></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <a href='category.php?cid=<?php echo $row['category'];?>'><?php echo $row['category_name'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php?aid=<?php echo $row['author']?>'><?php echo $row['first_name']." ".$row['last_name'];?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?php echo $row['post_date'];?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?php echo $row['post_img'];?>" alt=""/>
                            <p class="description">
                                <?php echo $row['description'];?>
                            </p>
                        </div>
                    </div>
                    <?php
                       }
            }
                    ?>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
