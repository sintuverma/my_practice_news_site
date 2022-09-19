<?php include "header.php";
  if($_SESSION['role']=='0'){
    header("Location:{$hostname}/admin/post.php");
  }
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php
                    include 'config.php';
                    $limit=3;
                    //$page = $_GET['page'];
                    //echo $page;
                    if(isset($_GET['page'])){
                      $page=$_GET['page'];
                    }else{
                      $page =1;
                    }
                    
                    
                    $offset = ($page-1) * $limit;
                    //
                    echo $offset;
                    $sqls="SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                    $results=mysqli_query($conn,$sqls) or die("Query is Failed.");//value assign in result who comings from database
                    if(mysqli_num_rows($results) > 0){
                     ?>       
                    
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>Email ID</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        $i=0;
                        while ($row=mysqli_fetch_assoc($results)) {
                          //print_r($row);
                          $i++;
                        ?>
                          <tr>
                              <td class='id'><?php echo $i;?></td>
                              <td><?php echo $row['first_name']." ".$row['last_name'];?></td>
                              <td><?php echo $row['email'];?></td>
                              <?php
                              
                                //echo $row['role'];
                               if($row['role']==0)
                               {
                                 echo "<td>Normal</td>";
                               }
                                else
                                   {
                                     echo "<td>Admin</td>";
                                   }
                              ?>
                              <td class='edit'><a href='update-user.php?id=<?php echo $row["user_id"];?> '><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete_users.php?id=<?php echo $row["user_id"];?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                        <?php
                      
                          }//while loop bracket closed..
                        ?>
                      </tbody>
                      
                  </table>
                  <?php
                    }// condition for loop closed.
                
                  $sqlp= "SELECT * FROM user";
                    $queryp=mysqli_query($conn,$sqlp) or die("Query is failed");

                    if(mysqli_num_rows($queryp) > 0){

                      $total_rocords= mysqli_num_rows($queryp);
                       //$totalNumbers=count($queryp);
                       //echo $totalNumbers;
                      $limit=3;
                      $total_page= ceil($total_rocords / $limit);//if record available 15 in db then it will show 5 number of page and pagination button. 
                      echo "<ul class='pagination admin-pagination'>";
                      if($page >1){
                              echo'<li ><a href="users.php?page='.($page-1).'">Prev</a></li>';
                            }
                      for($j=1;$j<=$total_page;$j++){
                           
                           if($j==$page){
                            $active="active";

                           }else{
                            $active ="";

                           }
                           echo "<li class='$active'><a href='users.php?page={$j}'>{$j}</a></li>";

                      }
                       if($total_page>$page){
                        echo'<li ><a href="users.php?page='.($page+1).'">Next</a></li>';
                      }
                          
                        echo'</ul>';
                    }
                  
                    ?>
                  
                      <!-- <li class="active"><a>1</a></li> -->
                      
                  
              </div>
          </div>
      </div>
  </div>

