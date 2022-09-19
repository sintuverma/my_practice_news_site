<!-- Footer -->
<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                include 'config.php';
                $sqlse="SELECT * FROM settings";
                $queryse=mysqli_query($conn,$sqlse);
                if(mysqli_num_rows($queryse)>0){
                  while($rowse=mysqli_fetch_assoc($queryse)){
                    //print_r($rowse);
                ?>
                <span> <?php echo $rowse['footerDesc'];?><a href="http://yahoobaba.net/">home</a></span>
                <?php
                }
             }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>
