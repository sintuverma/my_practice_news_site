<?php include "header.php";
  if($_SESSION['role']=='0'){
    header("Location:{$hostname}/admin/post.php");
  } 
  ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php 
                        include'config.php';
                        $limit=3;
                        if(isset($_GET['page']) ){
                            $page=$_GET['page'];

                        }
                        else{
                            $page=1;
                        }
                        $offset=($page-1)*$limit;

                            $sqlc1="SELECT * FROM category ORDER BY category_name ASC LIMIT {$offset},{$limit}";
                            $resultc1= mysqli_query($conn,$sqlc1);
                            $total_table_records_number=mysqli_num_rows($resultc1);
                            //echo $total_table_records_number;
                            if(mysqli_num_rows($resultc1)>0){
                                while ($rowc1=mysqli_fetch_assoc($resultc1)) {
                                    //print_r($rowc1);

                        ?>
                        <tr>
                            <td class='id'><?php echo $rowc1['category_id'];?></td>
                            <td><?php echo $rowc1['category_name'];?></td>
                            <td><?php echo $rowc1['post'];?></td>
                            <td class='edit'><a href='update-category.php?id=<?php echo $rowc1['category_id'];?>'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete_category.php?id=<?php echo $rowc1['category_id'];?>'><i class='fa fa-trash-o'></i></a></td>
                        </tr>
                        <?php
                         }
                            }
                            else{
                                echo "Record not found";
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                $sqlc="SELECT * FROM category";
                $queryc=mysqli_query($conn,$sqlc) or die("Query is failed");
                $total_records=mysqli_num_rows($queryc);
                //print($total_records);

                // total page nikalne ke liye database me rakhe record ko limit se devide kar do jaise to utne hi page ban jayenge maan lo total records db me(15) aur ek page me data show karane ki limit 3 hai to to tumhare 5 page ke button aur 5 page ho jayenge and floor function bas apko float value(5.3) nahi poori 6 value dega.

                $total_page=floor($total_records/$limit);
                 echo "<ul class='pagination admin-pagination'>";
                 if($page>1){
                    echo'<li ><a href="category.php?page='.($page-1).'">Prev</a></li>';
                    //echo '<li ><a href="users.php?page={($page-1)}">Next</a></li>';
                 }
                    for($i=1; $i<=$total_page+1; $i++){
                        if ($i==$page) {
                            //echo $i." ".$i;
                            $active="active";
                        }
                        else{
                            $active="";
                        }
                        echo " <li class='$active'><a href='category.php?page={$i}'>{$i}</a></li> ";
                    }
                    if($total_page>$page){
                        echo'<li ><a href="category.php?page='.($page+1).'">Next</a></li>';
                    }
                    
                echo "</ul>";
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
