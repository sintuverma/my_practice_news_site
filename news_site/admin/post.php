
<?php include "header.php"; ?>

  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
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
                    //
                    //echo $offset;
                     if($_SESSION['role']=='1'){
                    $sqls="SELECT post.post_id, post.title, post.description, post.post_date, category.category_name,user.email,post.category FROM post 
                    LEFT JOIN category on post.category= category.category_id
                    LEFT JOIN user ON post. author = user.user_id
                    ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";

                  }elseif($_SESSION['role']=='0'){
                    $sqls="SELECT post.post_id, post.title, post.description, post.post_date, category.category_name,user.email,post.category FROM post 
                    LEFT JOIN category on post.category= category.category_id
                    LEFT JOIN user ON post. author = user.user_id WHERE post.author={$_SESSION['user_id']}
                    ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                  }
                    // echo $sqls; for check sql query.
                    // die(); dont run next code exit here.
                    $results=mysqli_query($conn,$sqls) or die("Query is Failed.");//value assign in result who comings from database
                    if(mysqli_num_rows($results) > 0){
                     ?>       
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        $serial_num= $offset+1;
                        while ($rowp=mysqli_fetch_assoc($results)) {
                          //print_r($rowp);
                        ?>
                          <tr>
                              <td class='id'><?php echo $serial_num; ?></td>
                              <td><?php echo $rowp['title'];?></td>
                              <td><?php echo $rowp['category_name'];?></td>
                              <td><?php echo $rowp['post_date'];?></td>
                              <td><?php echo $rowp['email'];?></td>
                              <td class='edit'><a href='update-post.php?post_Id=<?php echo $rowp['post_id'];?>'><i class='fa fa-edit'></i></a></td>
                              <!-- we are sending both category and post id  -->
                              
                              <td class='delete'><a href='delete_post.php?post_Id=<?php echo $rowp['post_id'];?>&cat_Id=<?php echo $rowp['category'];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                          $serial_num++;
                          }
                        ?>
                      </tbody>
                  </table>
                                    <?php
                    }// condition for loop closed.
                
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
                              echo'<li ><a href="post.php?page='.($page-1).'">Prev</a></li>';
                            }
                      for($j=1;$j<=$total_page;$j++){
                           
                           if($j==$page){
                            $active="active";

                           }else{
                            $active ="";

                           }
                           echo "<li class='$active'><a href='post.php?page={$j}'>{$j}</a></li>";

                      }
                       if($total_page>$page){
                        echo'<li ><a href="post.php?page='.($page+1).'">Next</a></li>';
                      }
                          
                        echo'</ul>';
                    }
                  
                    ?>
                  
                      <!-- <li class="active"><a>1</a></li> -->
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
