<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <?php
                    include 'config.php';//connection configuration file
                    $limit=3;
                    //$page = $_GET['page'];
                    //echo $page;
                    if(isset($_GET['page'])){
                      $page=$_GET['page'];
                    }else{
                      $page =1;
                    }
                    $offset = ($page-1) * $limit;// offset logic

                    $sqls="SELECT post.post_id, post.title, post.description, post.post_date,post_img,post.author,category.category_name,user.first_name,user.last_name,post.category FROM post 
                    LEFT JOIN category on post.category= category.category_id
                    LEFT JOIN user ON post. author = user.user_id
                    ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                    $query=mysqli_query($conn,$sqls) or die("Query is Failed.");//value assign in result who comings from database
                    if(mysqli_num_rows($query) > 0){
                        while ($row=mysqli_fetch_assoc($query)) {
                            // print_r($row);
                            // die();
                     ?>       
                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href='single.php?id=<?php echo $row['post_id'];?>'><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id'];?>'><?php echo $row['title'];?></a></h3>
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
                                        <p class="description">
                                            <?php echo substr($row['description'], 0,70)."...";?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php 
                } // while loop bracket closed
            }// if condition bracket closed 
            else{
                echo" <h2> Sorry Record not Found..<h2>";
            }
                    ?>
                        <?php
                                          $sqlp= "SELECT * FROM post";
                    $queryp=mysqli_query($conn,$sqlp) or die("Query is failed");

                    if(mysqli_num_rows($queryp) > 0){

                      $total_rocords= mysqli_num_rows($queryp);
                       //$totalNumbers=count($queryp);
                       //echo $totalNumbers;
                      $limit=3;
                      $total_page= ceil($total_rocords / $limit);//if record available 15 in db then it will show 5 number of page and pagination button. 
                      echo "<ul class='pagination admin-pagination'>";
                      if($page >1){
                              echo'<li ><a href="index.php?page='.($page-1).'">Prev</a></li>';
                            }
                      for($j=1;$j<=$total_page;$j++){
                           
                           if($j==$page){
                            $active="active";

                           }else{
                            $active ="";

                           }
                           echo "<li class='$active'><a href='index.php?page={$j}'>{$j}</a></li>";

                      }
                       if($total_page>$page){
                        echo'<li ><a href="index.php?page='.($page+1).'">Next</a></li>';
                      }
                          
                        echo'</ul>';
                    }
                  
                    ?>
                  
<!--                         <ul class='pagination'>
                            <li class="active"><a href="">1</a></li>
                            <li><a href="">2</a></li>
                            <li><a href="">3</a></li>
                        </ul> -->
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
