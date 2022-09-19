<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
                 
        <h4>Recent Posts</h4>
                    <?php
                    include 'config.php';//connection configuration file
                    $limit=3;
            
                    $sqls="SELECT post.post_id, post.title,post.post_date,post.post_img,post.author,category.category_name,post.category FROM post 
                    LEFT JOIN category on post.category= category.category_id
                    LEFT JOIN user ON post. author = user.user_id
                    ORDER BY post.post_id DESC LIMIT {$limit}";
                    $query=mysqli_query($conn,$sqls) or die("Query is Failed.");//value assign in result who comings from database
                    if(mysqli_num_rows($query) > 0){
                        while ($row=mysqli_fetch_assoc($query)) {
                            // print_r($row);
                            //  die();
                    
                     ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $row['post_id'];?>">
                <img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $row['post_id']?>"><?php echo $row['title']; ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?aid=<?php echo $row['category_id'];?>'><?php echo $row['category_name']; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $row['post_date'];?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $row['post_id'];?>">read more</a>
            </div>
        </div>
        <?php 
                 }
                     }
             ?>
    </div>
    <!-- /recent posts box -->
</div>